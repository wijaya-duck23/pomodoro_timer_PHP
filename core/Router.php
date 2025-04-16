<?php
class Router {
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    // Register a GET route
    public function get($uri, $controller, $action) {
        $this->routes['GET'][$uri] = ['controller' => $controller, 'action' => $action];
    }

    // Register a POST route
    public function post($uri, $controller, $action) {
        $this->routes['POST'][$uri] = ['controller' => $controller, 'action' => $action];
    }

    // Load route configuration
    public function load($file) {
        require $file;
        return $this;
    }

    // Direct traffic based on URI and method
    public function direct($uri, $requestMethod) {
        // Remove query string if any
        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        
        // Remove trailing slash if present
        $uri = rtrim($uri, '/');
        
        // Default route if empty
        if (empty($uri)) {
            $uri = '/';
        }

        if (array_key_exists($uri, $this->routes[$requestMethod])) {
            $route = $this->routes[$requestMethod][$uri];
            
            // Call the controller action
            $controller = $route['controller'];
            $action = $route['action'];
            
            $controllerPath = "app/controllers/{$controller}.php";
            
            if (file_exists($controllerPath)) {
                require_once $controllerPath;
                $controllerInstance = new $controller();
                
                if (method_exists($controllerInstance, $action)) {
                    return $controllerInstance->$action();
                }
            }
            
            throw new Exception("Controller or action not found: {$controller}@{$action}");
        }
        
        // Route not found
        header('HTTP/1.0 404 Not Found');
        require 'app/views/404.php';
    }
} 