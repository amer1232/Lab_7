<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include 'db.php';
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Users</title></head><body>
<h2>Welcome, <?=htmlspecialchars($_SESSION['name'])?> | <a href="logout.php">Logout</a></h2>

<table border="1" cellpadding="8" cellspacing="0">
  <tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Actions</th></tr>
  <?php
  $res = $conn->query("SELECT id, matric, name, accessLevel FROM users");
  while ($row = $res->fetch_assoc()):
  ?>
    <tr>
      <td><?=htmlspecialchars($row['matric'])?></td>
      <td><?=htmlspecialchars($row['name'])?></td>
      <td><?=htmlspecialchars($row['accessLevel'])?></td>
      <td>
        <a href="update.php?id=<?= $row['id'] ?>">Update</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
</body></html>
