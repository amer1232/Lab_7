<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $id = intval($_POST['id']);
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $accessLevel = $_POST['accessLevel'];

    $stmt = $conn->prepare("UPDATE users SET matric=?, name=?, accessLevel=? WHERE id=?");
    $stmt->bind_param("sssi",$matric,$name,$accessLevel,$id);
    if ($stmt->execute()) {
        header('Location: list.php');
        exit;
    } else {
        $error = "Error: " . $conn->error;
    }
}

if (isset($error)):
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error | Lab 7</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="logo">❌</div>
      <h2>Update Failed</h2>
      <div class="error-message" style="margin: 20px 0;">
        <?= htmlspecialchars($error) ?>
      </div>
      <a href="list.php" class="btn btn-secondary" style="width: 100%;">Back to List</a>
    </div>
  </div>
</body>
</html>
<?php endif; ?>
