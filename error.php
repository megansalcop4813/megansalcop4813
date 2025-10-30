<?php
// default error message
$error_message = "Invalid Username or Password.";

// check for a message parameter in the url
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'empty':
            $error_message = "Please enter both Username and Password.";
            break;
        case 'invalid':
            $error_message = "Invalid Username or Password.";
            break;
        default:
            $error_message = "An error occurred. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login error</title>
    <style>
        /* reset default spacing */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* main page setup */
        body {
            font-family: arial, sans-serif;
            background: linear-gradient(135deg, #fcababff 0%, #ff1b1bff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* box around the error message */
        .error-container {
            background: #fff;
            padding: 28px;
            border-radius: 6px;
            border: 1px solid #e6e6e6;
            width: 100%;
            max-width: 460px;
            text-align: center;
        }

        /* title text */
        h1 {
            color: #c0392b;
            margin-bottom: 12px;
            font-size: 20px;
        }

        /* the specific error message text */
        .error-message {
            color: #444;
            margin-bottom: 18px;
            font-size: 15px;
        }

        /* button styling */
        .btn {
            display: inline-block;
            padding: 10px 18px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
        }

        /* slight fade when hovering */
        .btn:hover {
            opacity: 0.95;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- page heading -->
        <h1>LOGIN FAILED</h1>

        <!-- display the correct error message -->
        <p class="error-message">
            <?php echo htmlspecialchars($error_message); ?>
        </p>

        <!-- back to login button -->
        <a href="login.php" class="btn">← back to login</a>
    </div>
</body>
</html>