<!-- register.php -->
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Register</h2>
  <form method="post" action="register_action.php">
    <label>Matric:</label><br>
    <input name="matric" required><br>

    <label>Name:</label><br>
    <input name="name" required><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Role:</label><br>
    <select name="accessLevel" required>
      <option value="student">Student</option>
      <option value="lecturer">Lecturer</option>
    </select><br><br>

    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
