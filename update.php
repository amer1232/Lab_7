<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT matric, name, email, accessLevel FROM users WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if (!$user = $result->fetch_assoc()) { die('User not found'); }
?>
<form method="post" action="update_action.php">
  <input type="hidden" name="id" value="<?= $id ?>">
  Matric: <input name="matric" value="<?=htmlspecialchars($user['matric'])?>" required><br>
  Name: <input name="name" value="<?=htmlspecialchars($user['name'])?>" required><br>
  Email: <input name="email" value="<?=htmlspecialchars($user['email'])?>"><br>
  Role: <select name="accessLevel">
    <option <?= $user['accessLevel']=='student'?'selected':'' ?> value="student">Student</option>
    <option <?= $user['accessLevel']=='lecturer'?'selected':'' ?> value="lecturer">Lecturer</option>
  </select><br><br>
  <button type="submit">Save</button>
</form>
