-- Create database
CREATE DATABASE IF NOT EXISTS pomodoro_db;
USE pomodoro_db;

-- Create sessions table
CREATE TABLE IF NOT EXISTS sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_type ENUM('focus', 'short_break', 'long_break') NOT NULL DEFAULT 'focus',
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    duration_min INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 