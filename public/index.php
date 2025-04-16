<?php
// Bootstrap the application

// Load configuration
require_once '../config/config.php';

// Autoload core classes
spl_autoload_register(function($className) {
    // Check core directory
    if (file_exists('../core/' . $className . '.php')) {
        require_once '../core/' . $className . '.php';
    } 
    // Check models directory
    else if (file_exists('../app/models/' . $className . '.php')) {
        require_once '../app/models/' . $className . '.php';
    }
    // Check controllers directory
    else if (file_exists('../app/controllers/' . $className . '.php')) {
        require_once '../app/controllers/' . $className . '.php';
    }
});

// Get the URL from the request
$uri = $_SERVER['REQUEST_URI'];

// Remove base path from URI if needed
$basePath = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
$uri = str_replace($basePath, '', $uri);

// Instantiate router
$router = new Router();

// Load routes
$router->load('../routes/web.php');

// Direct the request
try {
    $router->direct($uri, $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} 