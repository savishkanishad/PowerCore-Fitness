<?php
session_start();

require_once 'db_connect.php';


$name = $email = $message = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $_SESSION['contact_success'] = 'Message sent successfully!';
            header("Location: contactus.php");
        } else {
             $_SESSION['contact_error'] = 'Error: ' . addslashes($stmt->error);
             header("Location: contactus.php");
        }
        $stmt->close();
    } else {
        $error_message = implode("\\n", array_map('addslashes', $errors));
        $_SESSION['contact_error'] = $error_message;
        header("Location: contactus.php");
    }
}

$conn->close();
?>