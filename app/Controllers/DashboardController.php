<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Site;
use App\Models\EmailLog;
use App\Models\User;
use App\Models\Subscription;

class DashboardController extends Controller {
    public function __construct() {
        if (!Session::has('user_id')) {
            $this->redirect('/login');
        }
    }

    public function index() {
        $userId = (int) Session::get('user_id');

        $siteModel = new Site();
        $logModel = new EmailLog();
        $userModel = new User();
        $subModel = new Subscription();

        $status = trim((string) ($_GET['status'] ?? ''));
        $siteId = (int) ($_GET['site_id'] ?? 0);

        $user = $userModel->find($userId);
        $subscription = $subModel->getActiveSubscription($userId);
        $sentEmails = $logModel->countSentByUser($userId);
        $activeSites = $siteModel->countActiveByUser($userId);

        $quotaRemaining = 'Illimité';
        if (!$subscription || ($subscription['slug'] ?? 'free') === 'free') {
            $quotaRemaining = max(0, (int) $user['trial_limit'] - (int) $user['trial_emails_sent']);
        }

        return $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'user' => $user,
            'sites' => $siteModel->getByUserId($userId),
            'recent_logs' => $logModel->getRecentByUser($userId, 20, $status, $siteId),
            'subscription' => $subscription,
            'emails_sent' => $sentEmails,
            'sites_count' => $activeSites,
            'quota_remaining' => $quotaRemaining,
            'filters' => ['status' => $status, 'site_id' => $siteId],
            'success' => Session::flash('success'),
            'error' => Session::flash('error')
        ], 'dashboard');
    }
}
