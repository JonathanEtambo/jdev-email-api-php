<?php
namespace App\Core;

abstract class Controller {
    protected function render($view, $data = [], $layout = 'main') {
        extract($data);
        
        // Démarrage de la mise en mémoire tampon
        ob_start();
        require_once APP_ROOT . "/app/Views/$view.php";
        $content = ob_get_clean();

        // Inclusion du layout
        require_once APP_ROOT . "/app/Views/layouts/$layout.php";
    }

    protected function json($data, $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: " . APP_URL . $url);
        exit;
    }
}