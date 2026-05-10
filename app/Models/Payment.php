<?php
namespace App\Models;

use App\Core\Model;

class Payment extends Model {
    protected $table = 'payments';

    public function createPending($userId, $subscriptionId, $amount, $method, $details = []) {
        $sql = "INSERT INTO {$this->table} (user_id, subscription_id, transaction_id, amount, currency, payment_method, status, payment_details) VALUES (:user_id, :subscription_id, :transaction_id, :amount, 'USD', :payment_method, 'pending', :payment_details)";
        $stmt = $this->db->prepare($sql);
        $transactionId = 'PAY-' . strtoupper(bin2hex(random_bytes(6)));
        $stmt->execute([
            ':user_id' => $userId,
            ':subscription_id' => $subscriptionId,
            ':transaction_id' => $transactionId,
            ':amount' => $amount,
            ':payment_method' => $method,
            ':payment_details' => json_encode($details, JSON_UNESCAPED_UNICODE)
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function getPendingWithUser() {
        $stmt = $this->db->query("SELECT p.*, u.name as user_name, u.email as user_email, s.plan_id, pl.name as plan_name, pl.duration_months FROM {$this->table} p INNER JOIN users u ON u.id = p.user_id LEFT JOIN subscriptions s ON s.id = p.subscription_id LEFT JOIN plans pl ON pl.id = s.plan_id WHERE p.status = 'pending' ORDER BY p.created_at ASC");
        return $stmt->fetchAll();
    }

    public function findWithRelations($id) {
        $stmt = $this->db->prepare("SELECT p.*, s.user_id as subscription_user_id, s.id as sub_id FROM {$this->table} p LEFT JOIN subscriptions s ON s.id = p.subscription_id WHERE p.id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function markPaid($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'paid', paid_at = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function markFailed($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'failed' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByUser($userId) {
        $stmt = $this->db->prepare("SELECT p.*, pl.name as plan_name FROM {$this->table} p LEFT JOIN subscriptions s ON s.id = p.subscription_id LEFT JOIN plans pl ON pl.id = s.plan_id WHERE p.user_id = ? ORDER BY p.created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
