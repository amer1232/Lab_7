<!-- login.php -->
<?php 
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="logo">🔐</div>
      <h2>Welcome Back</h2>
      <p class="subtitle">Sign in to your account to continue</p>

      <?php 
      if (!empty($_GET['error'])) {
          echo "<div class='error-message'>" . htmlspecialchars($_GET['error']) . "</div>";
      }
      ?>

      <form method="post" action="login_action.php">
        <div class="form-group">
          <label for="matric">Matric Number</label>
          <input type="text" id="matric" name="matric" placeholder="Enter your matric number" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit">Sign In</button>
      </form>

      <p class="footer-text">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </div>
</body>
</html>
