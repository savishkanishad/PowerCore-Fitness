<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: programs.php#login-form");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PowerCore Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        .dashboard-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 100px auto;
            text-align: center;
        }
        .dashboard-header {
            margin-bottom: 2rem;
        }
        .btn-logout {
            background-color: #f44336;
        }
        .btn-logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <nav>
      <div class="nav__logo">
        <a href="#"><img src="assets/GGWP-removebg-preview.png" alt="logo" /></a>
      </div>
      <ul class="nav__links">
        <li class="link"><a href="index.html">Home</a></li>
        <li class="link"><a href="programs.php">Program</a></li>
        <li class="link"><a href="service.html">Service</a></li>
        <li class="link"><a href="about.html">About</a></li>
        <li class="link"><a href="contactus.php">Contact Us</a></li>
      </ul>
      <button class="btn btn-logout" onclick="window.location.href='logout.php'">Logout</button>
    </nav>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
            <p>You have successfully logged in to PowerCore Fitness.</p>
        </div>
        
        <div class="section__container">
            <h2>Your Active Program</h2>
            <div class="program__card" style="max-width: 400px; margin: 0 auto;">
                <h3>Member Details</h3>
                <p><strong>Member ID:</strong> <?php echo $_SESSION['id']; ?></p>
                <p>Status: Active</p>
            </div>
        </div>
    </div>

    <footer class="section__container footer">
      <p>© 2025 PowerCore Fitness. All rights reserved.</p>
    </footer>
</body>
</html>
