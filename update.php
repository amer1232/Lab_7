<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT matric, name, accessLevel FROM users WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if (!$user = $result->fetch_assoc()) { die('User not found'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="logo">✏️</div>
      <h2>Update User</h2>
      <p class="subtitle">Modify user information below</p>

      <form method="post" action="update_action.php">
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <div class="form-group">
          <label for="matric">Matric Number</label>
          <input type="text" id="matric" name="matric" value="<?=htmlspecialchars($user['matric'])?>" required>
        </div>

        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" value="<?=htmlspecialchars($user['name'])?>" required>
        </div>



        <div class="form-group">
          <label for="accessLevel">Access Level</label>
          <select id="accessLevel" name="accessLevel">
            <option <?= $user['accessLevel']=='student'?'selected':'' ?> value="student">Student</option>
            <option <?= $user['accessLevel']=='lecturer'?'selected':'' ?> value="lecturer">Lecturer</option>
          </select>
        </div>

        <button type="submit" class="btn-success">Save Changes</button>
      </form>

      <div class="divider"></div>
      <p class="footer-text"><a href="list.php">← Back to User List</a></p>
    </div>
  </div>
</body>
</html>
