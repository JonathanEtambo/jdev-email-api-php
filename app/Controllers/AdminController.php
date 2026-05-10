<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\CSRF;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Site;
use App\Models\EmailLog;

class AdminController extends Controller {
    private User $userModel;
    private Payment $paymentModel;
    private Subscription $subscriptionModel;
    private Site $siteModel;

    public function __construct() {
        if (!Session::has('user_id') || Session::get('user_role') !== 'admin') {
            $this->redirect('/dashboard');
        }
        $this->userModel = new User();
        $this->paymentModel = new Payment();
        $this->subscriptionModel = new Subscription();
        $this->siteModel = new Site();
    }

    public function index() {
        $logModel = new EmailLog();
        return $this->render('admin/index', [
            'title' => 'Administration',
            'users' => $this->userModel->allUsers(),
            'pendingPayments' => $this->paymentModel->getPendingWithUser(),
            'sites' => $this->siteModel->getAllWithOwners(),
            'logs' => $logModel->getRecentGlobal(20),
            'success' => Session::flash('success'),
            'error' => Session::flash('error')
        ], 'dashboard');
    }

    public function approvePayment($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $payment = $this->paymentModel->findWithRelations((int) $id);

        if (!$payment || $payment['status'] !== 'pending') {
            Session::flash('error', 'Paiement introuvable ou déjà traité.');
            return $this->redirect('/admin');
        }

        $this->paymentModel->markPaid((int) $id);

        if (!empty($payment['subscription_id'])) {
            $this->subscriptionModel->expireActiveByUser((int) $payment['user_id']);
            $this->subscriptionModel->activateById((int) $payment['subscription_id']);
        }

        Session::flash('success', 'Paiement validé et abonnement activé.');
        return $this->redirect('/admin');
    }

    public function rejectPayment($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $this->paymentModel->markFailed((int) $id);
        Session::flash('success', 'Paiement marqué en échec.');
        return $this->redirect('/admin');
    }

    public function suspendSite($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $this->siteModel->setActiveStatus((int) $id, 0);
        Session::flash('success', 'Site suspendu.');
        return $this->redirect('/admin');
    }

    public function activateSite($id) {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $this->siteModel->setActiveStatus((int) $id, 1);
        Session::flash('success', 'Site réactivé.');
        return $this->redirect('/admin');
    }
}
