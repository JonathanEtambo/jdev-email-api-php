<?php

// ===============================
// ENVIRONNEMENT / ERREURS
// ===============================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ===============================
// CORS GLOBAL POUR API
// Important pour les appels JS depuis localhost,
// HTTP, HTTPS ou un autre domaine.
// ===============================
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';

header("Access-Control-Allow-Origin: {$origin}");
header("Vary: Origin");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 86400");

// Réponse immédiate aux requêtes preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ===============================
// CONFIGURATION
// ===============================
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/functions.php';

// ===============================
// AUTOLOAD
// ===============================
spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));

    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR
        . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Classe introuvable : {$class}<br>Chemin testé : {$file}");
    }
});

// ===============================
// SESSION
// ===============================
\App\Core\Session::start();

// ===============================
// ROUTER
// ===============================
$router = new \App\Core\Router();

require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/api.php';

// ===============================
// URI NORMALISÉE
// ===============================
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$basePath = parse_url(APP_URL, PHP_URL_PATH) ?: '';
$uri = explode('?', $requestUri)[0];

if ($basePath && str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}

$uri = $uri === '' ? '/' : $uri;

// ===============================
// DISPATCH
// ===============================
$router->handle($_SERVER['REQUEST_METHOD'], $uri);