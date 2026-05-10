<?php
namespace App\Core;

class Session {
    /**
     * Démarre la session de manière sécurisée
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            // Options de sécurité pour le cookie de session
            session_start([
                'cookie_httponly' => true, // Empêche l'accès via JS (anti-XSS)
                'cookie_secure'   => isset($_SERVER['HTTPS']), // Uniquement via HTTPS si dispo
                'cookie_samesite' => 'Lax', // Protection contre CSRF
            ]);
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    /**
     * Flash messages (messages temporaires pour les notifications)
     */
    public static function flash($key, $message = null) {
        self::start();
        if ($message) {
            $_SESSION['flash'][$key] = $message;
        } else {
            $msg = $_SESSION['flash'][$key] ?? null;
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
    }
}