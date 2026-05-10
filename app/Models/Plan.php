<?php
namespace App\Models;

use App\Core\Model;

class Plan extends Model {
    protected $table = 'plans';

    /**
     * Récupère uniquement les plans actifs pour l'affichage public
     */
    public function getActivePlans() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY sort_order ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère un plan par son slug (ex: 'monthly', 'annual')
     */
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND is_active = 1 LIMIT 1");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
}