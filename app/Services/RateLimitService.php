<?php
namespace App\Services;

use App\Core\Database;

class RateLimitService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function checkLimit($apiKey, $limitPerMinute = 60, $endpoint = '/api/send-email') {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $now = date('Y-m-d H:i:s');

        $this->db->prepare('DELETE FROM api_rate_limits WHERE reset_at < ?')->execute([$now]);

        $stmt = $this->db->prepare('SELECT * FROM api_rate_limits WHERE api_key = ? AND ip_address = ? AND endpoint = ? LIMIT 1');
        $stmt->execute([$apiKey, $ip, $endpoint]);
        $record = $stmt->fetch();

        if (!$record) {
            $resetAt = date('Y-m-d H:i:s', strtotime('+1 minute'));
            $this->db->prepare('INSERT INTO api_rate_limits (api_key, ip_address, endpoint, request_count, reset_at) VALUES (?, ?, ?, 1, ?)')
                     ->execute([$apiKey, $ip, $endpoint, $resetAt]);

            return ['allowed' => true, 'retry_after_seconds' => 0];
        }

        if ((int) $record['request_count'] >= (int) $limitPerMinute) {
            $retryAfter = max(1, strtotime($record['reset_at']) - time());
            return ['allowed' => false, 'retry_after_seconds' => $retryAfter];
        }

        $this->db->prepare('UPDATE api_rate_limits SET request_count = request_count + 1 WHERE id = ?')
                 ->execute([$record['id']]);

        return ['allowed' => true, 'retry_after_seconds' => 0];
    }
}
