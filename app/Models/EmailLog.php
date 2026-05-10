<?php
namespace App\Models;

use App\Core\Model;

class EmailLog extends Model {
    protected $table = 'email_logs';

    public function log($data) {
        $sql = "INSERT INTO {$this->table} (user_id, site_id, recipient, subject, status, error_message, ip_address, user_agent) VALUES (:user_id, :site_id, :recipient, :subject, :status, :error_message, :ip_address, :user_agent)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':site_id' => $data['site_id'],
            ':recipient' => $data['recipient'],
            ':subject' => $data['subject'],
            ':status' => $data['status'],
            ':error_message' => $data['error_message'] ?? null,
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    }

    public function countSentByUser($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE user_id = ? AND status = 'sent'");
        $stmt->execute([$userId]);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public function getRecentByUser($userId, $limit = 10, $status = '', $siteId = 0) {
        $sql = "SELECT l.*, s.name as site_name FROM {$this->table} l INNER JOIN sites s ON s.id = l.site_id WHERE l.user_id = :user_id";
        $params = [':user_id' => $userId];

        if ($status !== '') {
            $sql .= " AND l.status = :status";
            $params[':status'] = $status;
        }

        if ($siteId > 0) {
            $sql .= " AND l.site_id = :site_id";
            $params[':site_id'] = $siteId;
        }

        $sql .= " ORDER BY l.sent_at DESC LIMIT :log_limit";
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':log_limit', (int) $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecentGlobal($limit = 30) {
        $stmt = $this->db->prepare("SELECT l.*, u.email as user_email, s.name as site_name FROM {$this->table} l INNER JOIN users u ON u.id = l.user_id INNER JOIN sites s ON s.id = l.site_id ORDER BY l.sent_at DESC LIMIT :log_limit");
        $stmt->bindValue(':log_limit', (int) $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
