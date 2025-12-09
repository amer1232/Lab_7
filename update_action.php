<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $id = intval($_POST['id']);
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $accessLevel = $_POST['accessLevel'];

    $stmt = $conn->prepare("UPDATE users SET matric=?, name=?, email=?, accessLevel=? WHERE id=?");
    $stmt->bind_param("ssssi",$matric,$name,$email,$accessLevel,$id);
    if ($stmt->execute()) {
        header('Location: list.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
