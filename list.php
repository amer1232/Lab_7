<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include 'db.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users List | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container wide">
    <div class="card">
      <div class="page-header">
        <h2>👥 User Management</h2>
        <div class="user-info">
          <span class="user-name">Welcome, <strong><?=htmlspecialchars($_SESSION['name'])?></strong></span>
          <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
      </div>

      <?php if (!empty($_GET['error'])): ?>
        <div class="error-message" style="margin-bottom: 20px;"><?= htmlspecialchars($_GET['error']) ?></div>
      <?php endif; ?>
      <?php if (!empty($_GET['success'])): ?>
        <div class="success-message" style="margin-bottom: 20px;"><?= htmlspecialchars($_GET['success']) ?></div>
      <?php endif; ?>

      <table>
        <thead>
          <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Access Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT id, matric, name, accessLevel FROM users");
          while ($row = $res->fetch_assoc()):
            $badgeClass = $row['accessLevel'] === 'lecturer' ? 'badge-lecturer' : 'badge-student';
          ?>
            <tr>
              <td><?=htmlspecialchars($row['matric'])?></td>
              <td><?=htmlspecialchars($row['name'])?></td>
              <td><span class="badge <?=$badgeClass?>"><?=htmlspecialchars($row['accessLevel'])?></span></td>
              <td>
                <div class="actions">
                  <a href="update.php?id=<?= $row['id'] ?>" class="edit-link">Edit</a>
                  <a href="delete.php?id=<?= $row['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
