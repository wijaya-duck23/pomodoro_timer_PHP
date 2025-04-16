<?php
class Session {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Get all sessions with newest first
    public function getAllSessions() {
        $this->db->query("SELECT * FROM sessions ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    
    // Get a single session by ID
    public function getSessionById($id) {
        $this->db->query("SELECT * FROM sessions WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Add a new completed session
    public function addSession($data) {
        // Prepare query
        $this->db->query("INSERT INTO sessions (session_type, start_time, end_time, duration_min, created_at) 
                         VALUES (:session_type, :start_time, :end_time, :duration_min, NOW())");
        
        // Bind values
        $this->db->bind(':session_type', $data['session_type']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        $this->db->bind(':duration_min', $data['duration_min']);
        
        // Execute
        return $this->db->execute();
    }
    
    // Get session statistics (total time, count by type, etc.)
    public function getStats() {
        $this->db->query("SELECT 
                            SUM(duration_min) as total_minutes,
                            COUNT(*) as total_sessions,
                            SUM(CASE WHEN session_type = 'focus' THEN 1 ELSE 0 END) as focus_count,
                            SUM(CASE WHEN session_type = 'short_break' THEN 1 ELSE 0 END) as short_break_count,
                            SUM(CASE WHEN session_type = 'long_break' THEN 1 ELSE 0 END) as long_break_count
                          FROM sessions");
        return $this->db->single();
    }
} 