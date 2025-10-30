-- create database
CREATE DATABASE IF NOT EXISTS login_system;
USE login_system;

-- create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- insert sample user (password is 'password123')
INSERT INTO users (username, password) VALUES 
('admin', '$2y$10$7YzCAgUbuZU1oO3AgwpTxOW6nGfnnEcyBirycrZqlJ.HPqwfPXl5a');

