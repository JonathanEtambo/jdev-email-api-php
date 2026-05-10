<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'users';

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, email, password, trial_limit) VALUES (:name, :email, :password, :trial_limit)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':trial_limit' => TRIAL_EMAIL_LIMIT
        ]);
    }

    public function incrementTrialEmails($userId) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET trial_emails_sent = trial_emails_sent + 1 WHERE id = ?");
        return $stmt->execute([$userId]);
    }

    public function allUsers() {
        $stmt = $this->db->query("SELECT id, name, email, role, status, trial_emails_sent, created_at FROM {$this->table} ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
