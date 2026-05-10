<?php
namespace App\Core;

class Router {
    protected $routes = [];

    public function add($method, $path, $handler) {
        $path = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[^/]+)', $path);
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => '#^' . $path . '$#',
            'handler' => $handler
        ];
    }

    public function handle($method, $uri) {
        $uri = explode('?', $uri)[0];
        $uri = rtrim($uri, '/');
        $uri = $uri === '' ? '/' : $uri;

        $method = strtoupper($method);
        $pathMatched = false;

        foreach ($this->routes as $route) {
            if (!preg_match($route['path'], $uri, $matches)) {
                continue;
            }

            $pathMatched = true;

            if ($route['method'] !== $method) {
                continue;
            }

            $handler = explode('@', $route['handler']);
            $controllerName = 'App\\Controllers\\' . $handler[0];
            $methodName = $handler[1];

            if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
                $controller = new $controllerName();
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func_array([$controller, $methodName], array_values($params));
            }
        }

        if ($pathMatched) {
            $this->abort(405, '405 - Method Not Allowed');
        }

        $this->abort(404, '404 - Page non trouvée');
    }

    protected function abort($code = 404, $message = '') {
        http_response_code($code);
        echo $message !== '' ? $message : '404 - Page non trouvée';
        exit;
    }
}
