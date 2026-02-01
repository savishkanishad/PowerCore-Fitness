<?php

    session_start();
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: programs.php");
        exit();
    }
    require_once 'db_connect.php';

    // Get and sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone']);
    $program = trim($_POST['program']);

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($program)) {
         $_SESSION['register_error'] = 'All fields are required.';
         header("Location: programs.php#register-form");
         exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = 'Error: Passwords do not match.';
        header("Location: programs.php#register-form");
        exit();
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Error: Email already registered.';
        header("Location: programs.php#register-form");
        $checkEmail->close();
        exit();
    }
    $checkEmail->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and Bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, program) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $program);

        if ($stmt->execute()) {
             $_SESSION['login_success'] = 'Registration successful! Please login.';
             header("Location: programs.php#login-form");
        } else {
             // In production, log the error instead of showing it
             $_SESSION['register_error'] = 'Error registering user.';
             header("Location: programs.php#register-form");
        }
        $stmt->close();
    } else {
         $_SESSION['register_error'] = 'Database error.';
         header("Location: programs.php#register-form");
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>