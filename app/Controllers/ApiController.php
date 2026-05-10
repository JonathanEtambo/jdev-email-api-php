<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Site;
use App\Models\EmailLog;
use App\Models\Subscription;
use App\Services\MailService;
use App\Services\RateLimitService;
use Throwable;

class ApiController extends Controller
{
    private function cors(): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';

        header("Access-Control-Allow-Origin: {$origin}");
        header("Vary: Origin");
        header("Access-Control-Allow-Methods: POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With");
        header("Access-Control-Max-Age: 86400");
        header("Content-Type: application/json; charset=utf-8");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }

    private function errorResponse(int $status, string $message, string $code, array $extra = [])
    {
        return $this->json(array_merge([
            'success' => false,
            'error' => $message,
            'error_code' => $code
        ], $extra), $status);
    }

    private function hasHeaderInjection(string $value): bool
    {
        return preg_match('/[\r\n]/', $value) === 1;
    }

    public function sendEmail()
    {
        $this->cors();

        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->errorResponse(405, 'Method not allowed', 'method_not_allowed');
            }

            $rawBody = file_get_contents('php://input');
            $data = json_decode($rawBody, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
                return $this->errorResponse(400, 'Invalid JSON payload', 'invalid_json');
            }

            $required = ['site_id', 'public_key', 'secret_key', 'to', 'subject', 'html_content'];

            foreach ($required as $field) {
                if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
                    return $this->errorResponse(400, "Field '{$field}' is required", 'validation_error');
                }
            }

            $siteId = trim((string) $data['site_id']);
            $publicKey = trim((string) $data['public_key']);
            $secretKey = trim((string) $data['secret_key']);
            $to = trim((string) $data['to']);
            $subject = trim((string) $data['subject']);
            $htmlContent = (string) $data['html_content'];
            $textContent = isset($data['text_content']) ? (string) $data['text_content'] : '';

            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return $this->errorResponse(422, 'Recipient email is invalid', 'invalid_recipient');
            }

            if ($this->hasHeaderInjection($to) || $this->hasHeaderInjection($subject)) {
                return $this->errorResponse(422, 'Invalid characters in email or subject', 'header_injection_blocked');
            }

            if (mb_strlen($subject) > 500) {
                return $this->errorResponse(422, 'Subject is too long (max 500 chars)', 'subject_too_long');
            }

            if (mb_strlen($htmlContent) > 500000 || mb_strlen($textContent) > 500000) {
                return $this->errorResponse(413, 'Email content is too large', 'payload_too_large');
            }

            $siteModel = new Site();
            $userModel = new User();
            $logModel = new EmailLog();
            $subModel = new Subscription();
            $rateLimit = new RateLimitService();

            $site = $siteModel->verifyKeys($siteId, $publicKey, $secretKey);

            if (!$site) {
                return $this->errorResponse(401, 'Invalid API credentials or inactive site', 'invalid_credentials');
            }

            $limitPerMinute = max(1, (int) ($site['rate_limit_per_minute'] ?? RATE_LIMIT_DEFAULT));
            $limitResult = $rateLimit->checkLimit($publicKey, $limitPerMinute, '/api/send-email');

            if (!$limitResult['allowed']) {
                return $this->errorResponse(429, 'Rate limit exceeded', 'rate_limit_exceeded', [
                    'retry_after_seconds' => $limitResult['retry_after_seconds'] ?? 60
                ]);
            }

            $user = $userModel->find((int) $site['user_id']);

            if (!$user || ($user['status'] ?? 'suspended') !== 'active') {
                $logModel->log([
                    'user_id' => (int) ($site['user_id'] ?? 0),
                    'site_id' => (int) $site['id'],
                    'recipient' => $to,
                    'subject' => $subject,
                    'status' => 'blocked',
                    'error_message' => 'User account is not active'
                ]);

                return $this->errorResponse(403, 'User account is not active', 'user_inactive');
            }

            $subscription = $subModel->getActiveSubscription((int) $user['id']);
            $isTrialMode = !$subscription || (($subscription['slug'] ?? 'free') === 'free');

            $trialLimit = (int) ($user['trial_limit'] ?? TRIAL_EMAIL_LIMIT);
            $trialSent = (int) ($user['trial_emails_sent'] ?? 0);

            if ($isTrialMode && $trialSent >= $trialLimit) {
                $logModel->log([
                    'user_id' => (int) $user['id'],
                    'site_id' => (int) $site['id'],
                    'recipient' => $to,
                    'subject' => $subject,
                    'status' => 'blocked',
                    'error_message' => 'Trial limit reached'
                ]);

                return $this->errorResponse(403, 'Trial limit reached. Please subscribe.', 'trial_limit_reached');
            }

            $mailService = new MailService();
            $result = $mailService->sendHtmlMail($to, $subject, $htmlContent, $textContent);

            $status = $result['success'] ? 'sent' : 'failed';

            $logModel->log([
                'user_id' => (int) $user['id'],
                'site_id' => (int) $site['id'],
                'recipient' => $to,
                'subject' => $subject,
                'status' => $status,
                'error_message' => $result['error'] ?? null
            ]);

            if (!$result['success']) {
                return $this->errorResponse(502, $result['error'] ?? 'Email delivery failed', 'mail_delivery_failed');
            }

            $siteModel->incrementSentEmails((int) $site['id']);

            if ($isTrialMode) {
                $userModel->incrementTrialEmails((int) $user['id']);
            }

            $remainingEmails = $isTrialMode ? max(0, $trialLimit - ($trialSent + 1)) : 'unlimited';

            return $this->json([
                'success' => true,
                'message' => 'Email sent successfully',
                'data' => [
                    'site_id' => $siteId,
                    'status' => 'sent',
                    'remaining_emails' => $remainingEmails,
                    'plan_mode' => $isTrialMode ? 'trial' : 'paid'
                ]
            ]);

        } catch (Throwable $e) {
            return $this->errorResponse(500, 'Internal server error', 'internal_error');
        }
    }
}