<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
}
header('Location: list.php');
exit;
?>
