<?php
class PomodoroController {
    private $sessionModel;
    
    public function __construct() {
        $this->sessionModel = new Session();
    }
    
    // Load the main timer page
    public function index() {
        // Get session statistics for display
        $stats = $this->sessionModel->getStats();
        
        // Load the dashboard view
        require_once 'app/views/dashboard.php';
    }
    
    // Load the history page with all sessions
    public function history() {
        // Get all sessions from model
        $sessions = $this->sessionModel->getAllSessions();
        
        // Load the history view
        require_once 'app/views/history.php';
    }
    
    // Save a completed session (AJAX endpoint)
    public function save() {
        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the POST data
            $sessionData = [
                'session_type' => $_POST['session_type'] ?? 'focus',
                'start_time' => $_POST['start_time'] ?? null,
                'end_time' => $_POST['end_time'] ?? null,
                'duration_min' => $_POST['duration_min'] ?? 25
            ];
            
            // Validate required data
            if (!$sessionData['start_time'] || !$sessionData['end_time']) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                return;
            }
            
            // Save to database
            if ($this->sessionModel->addSession($sessionData)) {
                echo json_encode(['success' => true, 'message' => 'Session saved successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to save session']);
            }
        } else {
            // Not a POST request
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        }
    }
} 