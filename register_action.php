<?php
// register_action.php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Please login first'));
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $accessLevel = $_POST['accessLevel'];

    // basic validation
    if (empty($matric) || empty($name) || empty($password)) {
        die('Required fields missing.');
    }

    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // insert
    $stmt = $conn->prepare("INSERT INTO users (matric,name,email,password,accessLevel) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $matric, $name, $email, $hash, $accessLevel);
    if ($stmt->execute()) {
        echo "Registered successfully. <a href='login.php'>Go to login</a>";
    } else {
        // handle duplicate key
        if ($conn->errno === 1062) {
            echo "Matric already exists. Try a different matric.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
