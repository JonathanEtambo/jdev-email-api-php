<?php
namespace App\Models;

use App\Core\Model;

class Site extends Model {
    protected $table = 'sites';

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function findByUserAndId($userId, $id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = ? AND id = ? LIMIT 1");
        $stmt->execute([$userId, $id]);
        return $stmt->fetch();
    }

    public function createForUser($userId, array $data) {
        $sql = "INSERT INTO {$this->table} (user_id, name, domain, site_id, public_key, secret_key, rate_limit_per_minute, is_active) VALUES (:user_id, :name, :domain, :site_id, :public_key, :secret_key, :rate_limit, :is_active)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':name' => $data['name'],
            ':domain' => $data['domain'],
            ':site_id' => $data['site_id'],
            ':public_key' => $data['public_key'],
            ':secret_key' => $data['secret_key'],
            ':rate_limit' => $data['rate_limit_per_minute'],
            ':is_active' => $data['is_active']
        ]);
    }

    public function updateForUser($userId, $id, array $data) {
        $sql = "UPDATE {$this->table} SET name = :name, domain = :domain, rate_limit_per_minute = :rate_limit, is_active = :is_active WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':domain' => $data['domain'],
            ':rate_limit' => $data['rate_limit_per_minute'],
            ':is_active' => $data['is_active'],
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }

    public function deleteForUser($userId, $id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }

    public function regenerateKeys($userId, $id, $publicKey, $secretKey) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET public_key = :public_key, secret_key = :secret_key WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([
            ':public_key' => $publicKey,
            ':secret_key' => $secretKey,
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }

    public function setActiveStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_active = :status WHERE id = :id");
        return $stmt->execute([':status' => (int) $status, ':id' => $id]);
    }

    public function verifyKeys($siteId, $publicKey, $secretKey) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE site_id = :site_id AND public_key = :public_key AND secret_key = :secret_key AND is_active = 1 LIMIT 1");
        $stmt->execute([
            ':site_id' => $siteId,
            ':public_key' => $publicKey,
            ':secret_key' => $secretKey
        ]);
        return $stmt->fetch();
    }

    public function incrementSentEmails($siteId) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET emails_sent = emails_sent + 1 WHERE id = ?");
        return $stmt->execute([$siteId]);
    }

    public function countActiveByUser($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE user_id = ? AND is_active = 1");
        $stmt->execute([$userId]);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public function getAllWithOwners() {
        $stmt = $this->db->query("SELECT s.*, u.name as user_name, u.email as user_email FROM {$this->table} s INNER JOIN users u ON u.id = s.user_id ORDER BY s.created_at DESC");
        return $stmt->fetchAll();
    }
}
