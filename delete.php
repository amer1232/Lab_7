<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prevent users from deleting themselves
    if ($id == $_SESSION['user_id']) {
        header('Location: list.php?error=' . urlencode('You cannot delete your own account'));
        exit;
    }
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: list.php?success=' . urlencode('User deleted successfully'));
    } else {
        header('Location: list.php?error=' . urlencode('Failed to delete user: ' . $conn->error));
    }
    $stmt->close();
    exit;
}

header('Location: list.php');
exit;
?>
