<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Please login first'));
    exit;
}
// login_action.php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password, accessLevel FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // success: set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['matric'] = $matric;
            $_SESSION['name'] = $row['name'];
            $_SESSION['accessLevel'] = $row['accessLevel'];
            header('Location: list.php');
            exit;
        } else {
            header('Location: login.php?error=' . urlencode('Invalid password'));
            exit;
        }
    } else {
        header('Location: login.php?error=' . urlencode('No user with that matric'));
        exit;
    }
}
?>
