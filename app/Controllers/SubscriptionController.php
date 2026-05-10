<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\CSRF;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\Subscription;

class SubscriptionController extends Controller {
    private Plan $planModel;
    private Subscription $subscriptionModel;
    private Payment $paymentModel;

    public function __construct() {
        if (!Session::has('user_id')) {
            $this->redirect('/login');
        }
        $this->planModel = new Plan();
        $this->subscriptionModel = new Subscription();
        $this->paymentModel = new Payment();
    }

    public function index() {
        $userId = (int) Session::get('user_id');
        return $this->render('subscriptions/index', [
            'title' => 'Abonnements',
            'plans' => $this->planModel->getActivePlans(),
            'activeSubscription' => $this->subscriptionModel->getActiveSubscription($userId),
            'latestSubscription' => $this->subscriptionModel->getLatestByUser($userId),
            'payments' => $this->paymentModel->getByUser($userId),
            'success' => Session::flash('success'),
            'error' => Session::flash('error')
        ], 'dashboard');
    }

    public function checkout($planId) {
        $plan = $this->planModel->find((int) $planId);
        if (!$plan || (int) $plan['price'] <= 0) {
            Session::flash('error', 'Plan invalide pour paiement manuel.');
            return $this->redirect('/subscriptions');
        }

        return $this->render('subscriptions/checkout', [
            'title' => 'Paiement Manuel',
            'plan' => $plan
        ], 'dashboard');
    }

    public function storePayment() {
        CSRF::validate($_POST['csrf_token'] ?? '');
        $userId = (int) Session::get('user_id');

        $planId = (int) ($_POST['plan_id'] ?? 0);
        $method = trim((string) ($_POST['payment_method'] ?? 'manuel'));
        $reference = trim((string) ($_POST['reference'] ?? ''));

        $plan = $this->planModel->find($planId);
        if (!$plan) {
            Session::flash('error', 'Plan introuvable.');
            return $this->redirect('/subscriptions');
        }

        $startDate = date('Y-m-d H:i:s');
        $endDate = $plan['duration_months'] > 0
            ? date('Y-m-d H:i:s', strtotime('+' . (int) $plan['duration_months'] . ' month'))
            : date('Y-m-d H:i:s', strtotime('+1 year'));

        $subscriptionId = $this->subscriptionModel->createPending($userId, $planId, $startDate, $endDate);
        $this->paymentModel->createPending($userId, $subscriptionId, (float) $plan['price'], $method, [
            'reference' => $reference
        ]);

        Session::flash('success', 'Demande enregistrée. Paiement en attente de validation admin.');
        return $this->redirect('/subscriptions');
    }
}
