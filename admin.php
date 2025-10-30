<?php
session_start();

// prevent caching
header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// require login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// session timeout settings
$timeout_duration = 60;
$last = $_SESSION['last_activity'] ?? $_SESSION['login_time'] ?? time();
$elapsed = time() - $last;

if ($elapsed > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?msg=timeout");
    exit();
}

$remaining_time = $timeout_duration - $elapsed;
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        /* reset default margin/padding and set box sizing */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; font-family: Arial, sans-serif; }

        /* page background gradient and center content */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            display: flex; /* use flexbox for centering */
            justify-content: center; /* center horizontally */
            align-items: center; /* center vertically */
            padding: 20px;
        }

        /* main white container box */
        .container {
            background: white;
            width: 100%;
            max-width: 700px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        /* main heading */
        h1 {
            color: #333;
            font-size: 26px;
            margin-bottom: 15px;
        }

        /* welcome message styling with shadow effect */
        .welcome {
            font-size: 22px;
            margin-bottom: 25px;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-block;
            text-shadow: /* simple shadow outline */
                -1px -1px 0 #000,
                 1px -1px 0 #000,
                -1px  1px 0 #000,
                 1px  1px 0 #000;
        }

        /* grid for session info cards */
        .grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* wrap if screen is small */
            gap: 15px;
            margin-bottom: 25px;
        }

        /* individual info card */
        .card {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 6px;
            border-left: 4px solid #667eea;
            min-width: 180px;
        }

        /* session timer styling */
        .timer {
            font-size: 18px;
            font-weight: bold;
            color: #ff5353ff;
            margin-bottom: 20px;
            text-shadow: /* simple shadow outline */
                -1px -1px 0 #000,
                 1px -1px 0 #000,
                -1px  1px 0 #000,
                 1px  1px 0 #000;
        }

        /* logout button styling */
        .logout-btn {
            display: inline-block;
            padding: 10px 25px;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }

        /* hover effect for logout */
        .logout-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <!-- show logged in username -->
        <div class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></div>

        <!-- session info card -->
        <div class="grid">
            <div class="card">
                <strong>Login Time:</strong><br><?php echo date('H:i:s', $_SESSION['login_time']); ?>
            </div>
        </div>

        <!-- countdown timer -->
        <div class="timer" id="timer">
            Session expires in: <span id="countdown"><?php echo intval($remaining_time); ?></span>s
        </div>

        <!-- logout button -->
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <script>
        // initialize timer from php remaining time
        let timeLeft = <?php echo intval($remaining_time); ?>;
        const countdown = document.getElementById('countdown');
        const timer = document.getElementById('timer');

        // update countdown every second
        function updateTimer() {
            timeLeft--;
            countdown.textContent = timeLeft;

            // redirect to logout on timeout
            if (timeLeft <= 0) {
                window.location.href = 'logout.php?timeout=1';
            }
        }

        setInterval(updateTimer, 1000); // run every second
    </script>
</body>
</html>