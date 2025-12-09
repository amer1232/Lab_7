<!-- login.php -->
<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Please login first'));
    exit;
}?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <?php if (!empty($_GET['error'])) echo "<p style='color:red'>".htmlspecialchars($_GET['error'])."</p>"; ?>
  <form method="post" action="login_action.php">
    <label>Matric:</label><br>
    <input name="matric" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
  <p>No account? <a href="register.php">Register here</a></p>
</body>
</html>
