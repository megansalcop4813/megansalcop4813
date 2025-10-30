<?php
session_start();

// if user is already logged in, send them to admin page
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* reset default spacing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* page layout and background */
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* box that holds login form */
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        /* heading text */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* space between form fields */
        .form-group {
            margin-bottom: 20px;
        }

        /* label text above inputs */
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        /* input fields for username and password */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        /* login button styling */
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        /* slight lift when hovering button */
        button:hover {
            transform: translateY(-2px);
        }

        /* gray info box at bottom */
        .info {
            margin-top: 20px;
            padding: 15px;
            background: #f0f0f0;
            border-radius: 5px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- page title -->
        <h1>Login</h1>

        <!-- form sends data to authenticate.php -->
        <form action="authenticate.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- submit button -->
            <button type="submit">Login</button>
        </form>

        <!-- small info box with demo login -->
        <div class="info">
            <strong>Demo Credentials:</strong><br>
            username: admin<br>
            password: password123
        </div>
    </div>
</body>
</html>