<?php
namespace App\Models;

use App\Core\Model;

class Subscription extends Model {
    protected $table = 'subscriptions';

    public function getActiveSubscription($userId) {
        $stmt = $this->db->prepare("SELECT s.*, p.slug, p.name as plan_name, p.emails_limit, p.price FROM {$this->table} s INNER JOIN plans p ON s.plan_id = p.id WHERE s.user_id = :user_id AND s.status = 'active' AND s.end_date > NOW() ORDER BY s.end_date DESC LIMIT 1");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch();
    }

    public function getLatestByUser($userId) {
        $stmt = $this->db->prepare("SELECT s.*, p.name as plan_name, p.slug FROM {$this->table} s INNER JOIN plans p ON p.id = s.plan_id WHERE s.user_id = ? ORDER BY s.created_at DESC LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function createPending($userId, $planId, $startDate, $endDate) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (user_id, plan_id, status, start_date, end_date) VALUES (:user_id, :plan_id, 'pending', :start_date, :end_date)");
        $stmt->execute([
            ':user_id' => $userId,
            ':plan_id' => $planId,
            ':start_date' => $startDate,
            ':end_date' => $endDate
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function activateById($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'active', updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function expireActiveByUser($userId) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'expired' WHERE user_id = ? AND status = 'active'");
        return $stmt->execute([$userId]);
    }
}
