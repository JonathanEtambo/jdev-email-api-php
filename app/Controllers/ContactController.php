<?php
namespace App\Controllers;

use App\Core\Controller;

class ContactController extends Controller {
    public function dxCodeContact() {
        return $this->render('home/dx_contact', [
            'title' => 'DX-CODE - Contact'
        ], 'main');
    }

    public function sendDxCodeContact() {
        $rawBody = file_get_contents('php://input');
        $data = json_decode($rawBody, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return $this->json([
                'success' => false,
                'message' => 'Payload JSON invalide.',
                'error_code' => 'invalid_json'
            ], 400);
        }

        $name = trim((string) ($data['user_name'] ?? ''));
        $email = trim((string) ($data['user_email'] ?? ''));
        $service = trim((string) ($data['service'] ?? 'Non specifie'));
        $message = trim((string) ($data['message'] ?? ''));

        if ($name === '' || $email === '' || $message === '') {
            return $this->json([
                'success' => false,
                'message' => 'Les champs nom, email et message sont obligatoires.',
                'error_code' => 'validation_error'
            ], 422);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json([
                'success' => false,
                'message' => 'Email invalide.',
                'error_code' => 'invalid_email'
            ], 422);
        }

        if (
            !defined('DXCODE_SITE_ID') || DXCODE_SITE_ID === '' ||
            !defined('DXCODE_PUBLIC_KEY') || DXCODE_PUBLIC_KEY === '' ||
            !defined('DXCODE_SECRET_KEY') || DXCODE_SECRET_KEY === ''
        ) {
            return $this->json([
                'success' => false,
                'message' => 'Configuration API manquante. Renseignez DXCODE_SITE_ID, DXCODE_PUBLIC_KEY et DXCODE_SECRET_KEY dans config/config.php.',
                'error_code' => 'api_not_configured'
            ], 500);
        }

        $safeName = $this->cleanSingleLine($name);
        $safeService = $this->cleanSingleLine($service);

        $payload = [
            'site_id' => DXCODE_SITE_ID,
            'public_key' => DXCODE_PUBLIC_KEY,
            'secret_key' => DXCODE_SECRET_KEY,
            'to' => defined('DXCODE_CONTACT_TO') && DXCODE_CONTACT_TO !== '' ? DXCODE_CONTACT_TO : MAIL_FROM_EMAIL,
            'subject' => '[DX-CODE] Nouveau message de ' . $safeName,
            'html_content' => $this->buildHtmlBody($safeName, $email, $safeService, $message),
            'text_content' => $this->buildTextBody($safeName, $email, $safeService, $message)
        ];

        $apiUrl = APP_URL . '/api/send-email';

        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $responseBody = curl_exec($ch);

        if ($responseBody === false) {
            $curlError = curl_error($ch);
            curl_close($ch);

            return $this->json([
                'success' => false,
                'message' => 'Impossible de joindre l\'API email.',
                'error_code' => 'api_connection_failed',
                'details' => $curlError
            ], 502);
        }

        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            return $this->json([
                'success' => false,
                'message' => 'Reponse API non exploitable.',
                'error_code' => 'invalid_api_response'
            ], 502);
        }

        if (($decoded['success'] ?? false) === true) {
            return $this->json([
                'success' => true,
                'message' => 'Votre message a ete envoye avec succes via JDev Mail API.'
            ], 200);
        }

        return $this->json([
            'success' => false,
            'message' => $decoded['error'] ?? 'Echec de l\'envoi.',
            'error_code' => $decoded['error_code'] ?? 'send_failed',
            'api_response' => $decoded
        ], $statusCode > 0 ? $statusCode : 502);
    }

    private function cleanSingleLine(string $value): string {
        return trim(preg_replace('/[\r\n]+/', ' ', $value));
    }

    private function e(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    private function buildHtmlBody(string $name, string $email, string $service, string $message): string {
        $safeName = $this->e($name);
        $safeEmail = $this->e($email);
        $safeService = $this->e($service);
        $safeMessage = nl2br($this->e($message));

        return "<h2>Nouveau message DX-CODE</h2>"
            . "<p><strong>Nom:</strong> {$safeName}</p>"
            . "<p><strong>Email:</strong> {$safeEmail}</p>"
            . "<p><strong>Service:</strong> {$safeService}</p>"
            . "<p><strong>Message:</strong><br>{$safeMessage}</p>";
    }

    private function buildTextBody(string $name, string $email, string $service, string $message): string {
        return "Nouveau message DX-CODE\n"
            . "Nom: {$name}\n"
            . "Email: {$email}\n"
            . "Service: {$service}\n"
            . "Message:\n{$message}\n";
    }
}
