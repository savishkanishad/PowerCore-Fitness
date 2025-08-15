<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: programs.html");
        exit();
    }
    $conn = new mysqli("localhost", "root", "", "powercore_fitness");
    if ($conn->connect_error) {
        echo "<script>alert('Connection failed: " . addslashes($conn->connect_error) . "'); window.location.href='programs.html';</script>";
        exit();
    }

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $conn->real_escape_string($_POST['phone']);
    $program = $conn->real_escape_string($_POST['program']);

    
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO users (name, email, password, phone, program)
            VALUES ('$name', '$email', '$hashedPassword', '$phone', '$program')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='programs.html';</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($conn->error) . "'); window.location.href='programs.html';</script>";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>