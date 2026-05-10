<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

\App\Core\Session::start();

$router = new \App\Core\Router();

require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/api.php';

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$basePath = parse_url(APP_URL, PHP_URL_PATH) ?: '';
$uri = explode('?', $requestUri)[0];

if ($basePath && str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}

$uri = $uri === '' ? '/' : $uri;

$router->handle($_SERVER['REQUEST_METHOD'], $uri);
