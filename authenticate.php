<?php
require_once 'config.php';  // include database connection file
session_start();            // start or resume a session

// check if the form was submitted using the post method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // get form values, or set them to empty if not provided
    $username = $_POST['username'] ?? '';  
    $password = $_POST['password'] ?? '';
    
    // check if username or password is empty
    if (empty($username) || empty($password)) {
        header("Location: error.php?msg=empty"); // send to error page
        exit();
    }
    
    // connect to the database
    $conn = getDBConnection();
    
    // prepare sql statement to prevent sql injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // bind username as string
    $stmt->execute(); // run the query
    $result = $stmt->get_result(); // get results from query
    
    // check if username exists in database
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc(); // get the row as an array
        
        // verify that entered password matches the hashed one in the database
        if (password_verify($password, $user['password'])) {
            
            // prevent session fixation attacks by regenerating session id
            session_regenerate_id(true);
            
            // store user info in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['login_time'] = time();
            $_SESSION['last_activity'] = time();
            
            // close statement and database connection
            $stmt->close();
            $conn->close();
            
            // redirect user to admin page after successful login
            header("Location: admin.php");
            exit();
        }
    }
    
    // if username or password didn't match, redirects to error page
    $stmt->close();
    $conn->close();
    header("Location: error.php?msg=invalid");
    exit();
    
} else {
    // if page accessed directly, sends user back to login page
    header("Location: login.php");
    exit();
}
?>