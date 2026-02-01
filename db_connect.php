<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "powercore_fitness";

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4"); // Set charset to utf8mb4
} catch (mysqli_sql_exception $e) {
    // Log error to file (in a real production env) and show generic message
    error_log($e->getMessage());
    die("Connection failed. Please try again later.");
}
?>
