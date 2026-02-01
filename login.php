<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'All fields are required.';
        header("Location: programs.php#login-form");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Password is correct, start a new session
                session_regenerate_id();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;

                header("Location: dashboard.php");
            } else {
                $_SESSION['login_error'] = 'Incorrect password.';
                header("Location: programs.php#login-form");
            }
        } else {
            $_SESSION['login_error'] = 'No account found with that email.';
            header("Location: programs.php#login-form");
        }
        $stmt->close();
    } else {
         $_SESSION['login_error'] = 'Database error.';
         header("Location: programs.php#login-form");
    }
    $conn->close();
} else {
    header("Location: programs.php");
    exit();
}
?>
