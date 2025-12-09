<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Please login first'));
    exit;
}
// db.php
$host = 'localhost';
$user = 'root';
$pass = ''; // change if needed
$dbname = 'Lab_7';

// create mysqli connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// optional: set charset
$conn->set_charset('utf8mb4');
?>
