<?php
/**
 * Retourne l'URL complète pour un asset
 */
function asset($path) {
    return APP_URL . '/assets/' . ltrim($path, '/');
}

/**
 * Nettoie les données de sortie (XSS Protection)
 */
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Debug rapide
 */
function dd($data) {
    echo '<pre style="background:#000; color:#fff; padding:20px;">';
    print_r($data);
    echo '</pre>';
    die();
}