<?php
namespace App\Core;

class CSRF {
    /**
     * Génère un jeton CSRF et le stocke en session
     */
    public static function generate() {
        if (!Session::has(CSRF_TOKEN_NAME)) {
            $token = bin2hex(random_bytes(32));
            Session::set(CSRF_TOKEN_NAME, $token);
        }
        return Session::get(CSRF_TOKEN_NAME);
    }

    /**
     * Valide le jeton envoyé par le formulaire
     */
    public static function validate($token) {
        $storedToken = Session::get(CSRF_TOKEN_NAME);
        
        if (!$storedToken || !hash_equals($storedToken, $token)) {
            // En cas d'échec, on bloque tout
            http_response_code(403);
            die("Erreur de sécurité : Jeton CSRF invalide ou expiré.");
        }
        return true;
    }

    /**
     * Génère un champ HTML input caché prêt à l'emploi
     */
    public static function field() {
        $token = self::generate();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}