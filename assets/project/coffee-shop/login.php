<?php
/* ==========================================================
   login.php
   Staff Login Page
   ========================================================== */

session_start();

$error = "";

// If already logged in, go to staff page
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header("Location: staff.php");
  exit;
}

if (isset($_POST['submit'])) {
  $username = trim($_POST['username'] ?? "");
  $password = trim($_POST['password'] ?? "");

  if ($username == "barista" && $password == "coffee123") {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;

    header("Location: staff.php");
    exit;
  } else {
    $error = "Oops! Wrong username or password.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Staff Login - Robert's Coffee Shop</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <div class="navbar">
    <h1>☕ Robert's Coffee Shop</h1>
    <div class="nav-links">
      <a href="index.php">Order</a>
      <a href="customers.php">Customers</a>
      <a href="login.php">Staff Login</a>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <h2>🔐 Staff Login</h2>
      <p>Use the staff account to view the secret staff page.</p>

      <div class="success">
        Demo Login: <b>barista</b> / <b>coffee123</b>
      </div>

      <?php if ($error != ""): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" placeholder="barista" />

        <label>Password</label>
        <input type="password" name="password" placeholder="coffee123" />

        <button type="submit" name="submit">Log In</button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>