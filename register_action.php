<?php
// register_action.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $accessLevel = $_POST['accessLevel'];

    // basic validation
    if (empty($matric) || empty($name) || empty($password)) {
        showMessage('error', 'Required fields missing.', 'register.php');
        exit;
    }

    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // insert (without email)
    $stmt = $conn->prepare("INSERT INTO users (matric, name, password, accessLevel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $matric, $name, $hash, $accessLevel);
    if ($stmt->execute()) {
        showMessage('success', 'Registration successful! You can now login.', 'login.php');
    } else {
        // handle duplicate key
        if ($conn->errno === 1062) {
            showMessage('error', 'Matric already exists. Try a different matric.', 'register.php');
        } else {
            showMessage('error', 'Error: ' . $conn->error, 'register.php');
        }
    }
    $stmt->close();
}
$conn->close();

function showMessage($type, $message, $redirectUrl) {
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $type === 'success' ? 'Success' : 'Error' ?> | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="logo"><?= $type === 'success' ? '✅' : '❌' ?></div>
      <h2><?= $type === 'success' ? 'Success!' : 'Oops!' ?></h2>
      <div class="<?= $type ?>-message" style="margin: 20px 0;">
        <?= htmlspecialchars($message) ?>
      </div>
      <a href="<?= $redirectUrl ?>" class="btn <?= $type === 'success' ? 'btn-success' : 'btn-secondary' ?>" style="width: 100%;">
        <?= $type === 'success' ? 'Go to Login' : 'Try Again' ?>
      </a>
    </div>
  </div>
</body>
</html>
<?php
}
?>
