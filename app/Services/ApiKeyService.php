<?php
namespace App\Services;

class ApiKeyService {
    /**
     * Génère un identifiant de site unique (public)
     */
    public function generateSiteId() {
        return 'site_' . bin2hex(random_bytes(8));
    }

    /**
     * Génère une clé publique (préfixe jpk_ pour JDev Public Key)
     */
    public function generatePublicKey() {
        return 'jpk_' . bin2hex(random_bytes(16));
    }

    /**
     * Génère une clé secrète (préfixe jsk_ pour JDev Secret Key)
     */
    public function generateSecretKey() {
        return 'jsk_' . bin2hex(random_bytes(32));
    }
}