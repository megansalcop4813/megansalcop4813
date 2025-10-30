<?php
session_start();

// destroy all session data
$_SESSION = array();

// delete session cookies from browser
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// destroy the session 
session_destroy();

// check if logout was due to timeout
$message = isset($_GET['timeout']) ? 'timeout' : 'logout';

// redirect to login page with message
header("Location: login.php?msg=" . $message);
exit();
?>