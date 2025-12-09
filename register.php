<!-- register.php -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="logo">📝</div>
      <h2>Create Account</h2>
      <p class="subtitle">Join us today and get started</p>

      <form method="post" action="register_action.php">
        <div class="form-group">
          <label for="matric">Matric Number</label>
          <input type="text" id="matric" name="matric" placeholder="Enter your matric number" required>
        </div>

        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>



        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a secure password" required>
        </div>

        <div class="form-group">
          <label for="accessLevel">Access Level</label>
          <select id="accessLevel" name="accessLevel" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
          </select>
        </div>

        <button type="submit">Create Account</button>
      </form>

      <p class="footer-text">Already have an account? <a href="login.php">Sign in here</a></p>
    </div>
  </div>
</body>
</html>
