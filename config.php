<?php

// DATABASE CONFIGURATION CONSTANTS
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');              
define('DB_NAME', 'login_system');

// function to get database connection
function getDBConnection() {
    // create new MySQL connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // check if connection failed
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // return the connection object
    return $conn;
}

// session configuration for 1-minute timeout
ini_set('session.gc_maxlifetime', 60);  // server keeps session for 60 seconds
session_set_cookie_params(60);          // cookies expire in 60 seconds
?>