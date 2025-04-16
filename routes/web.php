<?php
// Define the routes for the application

// Main routes
$router->get('/', 'PomodoroController', 'index');
$router->get('/history', 'PomodoroController', 'history');

// API routes
$router->post('/api/save-session', 'PomodoroController', 'save'); 