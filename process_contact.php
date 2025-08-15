<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "powercore_fitness";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    echo "<script>alert('Connection failed: " . addslashes($conn->connect_error) . "'); window.location.href='contactus.html';</script>";
    exit();
}


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
            echo "<script>alert('Message sent successfully!'); window.location.href='contactus.html';</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($stmt->error) . "'); window.location.href='contactus.html';</script>";
        }
        $stmt->close();
    } else {
        
        $error_message = implode("\\n", array_map('addslashes', $errors));
        echo "<script>alert('$error_message'); window.location.href='contactus.html';</script>";
    }
}

$conn->close();
?>