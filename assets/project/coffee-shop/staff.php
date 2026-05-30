<?php
/* ==========================================================
   staff.php
   Protected Staff Page
   ========================================================== */

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'] ?? "Staff";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Staff Page - Robert's Coffee Shop</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <div class="navbar">
    <h1>☕ Robert's Coffee Shop</h1>
    <div class="nav-links">
      <a href="index.php">Order</a>
      <a href="customers.php">Customers</a>
      <a href="staff.php">Staff Area</a>
      <a href="logout.php">Log Out</a>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <h2>✅ Welcome to the Secret Staff Page</h2>

      <p>
        Hello, <b><?php echo htmlspecialchars($username); ?></b>!
        <span class="badge">Logged In</span>
      </p>

      <h3>Today's Staff Tasks</h3>
      <ul class="task-list">
        <li>Check today’s coffee orders</li>
        <li>Restock coffee beans and milk</li>
        <li>Clean the counter and prep station</li>
        <li>Update customer favorites board</li>
      </ul>

      <a class="btn" href="logout.php">Log Out</a>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>