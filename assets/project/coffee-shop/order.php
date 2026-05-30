<?php
/* ==========================================================
   index.php
   Coffee Order Form + Receipt
   ========================================================== */

// ---------- 1) Set default values ----------
$name = "";
$drink = "";
$size = "";
$isIced = false;
$qty = 1;
$error = "";
$price = 0;
$total = 0;

// ---------- 2) If form submitted, read values ----------
if (isset($_POST['submit'])) {
  $name  = trim($_POST['name'] ?? "");
  $drink = trim($_POST['drink'] ?? "");
  $size  = trim($_POST['size'] ?? "");
  $qty   = (int)($_POST['qty'] ?? 1);
  $isIced = isset($_POST['iced']);

  // ---------- 3) Validation ----------
  if ($name == "" || $drink == "" || $size == "") {
    $error = "Please fill in your name, drink, and size!";
  }

  if ($qty < 1) {
    $qty = 1;
  }

  // ---------- 4) Pricing ----------
  if ($size == "Small") {
    $price = 3;
  } elseif ($size == "Medium") {
    $price = 4;
  } elseif ($size == "Large") {
    $price = 5;
  }

  $total = $price * $qty;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Robert's Coffee Shop</title>
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
    <div class="card hero">
      <h2>Welcome to Robert’s Coffee Shop</h2>
      <p>Order your favorite drink, explore customers, or log in to the staff area.</p>
    </div>

    <div class="card">
      <h2>Place an Order</h2>

      <?php if ($error != ""): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <label>Your Name</label>
        <input
          type="text"
          name="name"
          placeholder="Mia"
          value="<?php echo htmlspecialchars($name); ?>"
        />

        <label>Drink</label>
        <input
          type="text"
          name="drink"
          placeholder="Latte"
          value="<?php echo htmlspecialchars($drink); ?>"
        />

        <label>Size</label>
        <select name="size" id="size">
          <option value="">-- Choose size --</option>
          <option value="Small" <?php if ($size == "Small") echo "selected"; ?>>Small</option>
          <option value="Medium" <?php if ($size == "Medium") echo "selected"; ?>>Medium</option>
          <option value="Large" <?php if ($size == "Large") echo "selected"; ?>>Large</option>
        </select>

        <div class="checkbox-row">
          <input type="checkbox" name="iced" id="iced" <?php if ($isIced) echo "checked"; ?> />
          <label for="iced" style="margin:0;">Make it Iced?</label>
        </div>

        <label>Quantity</label>
        <input
          type="number"
          name="qty"
          id="qty"
          value="<?php echo $qty; ?>"
          min="1"
        />

        <p class="badge" id="totalPreview">Live Total Preview: Choose a size first</p>

        <div class="top-space">
          <button type="submit" name="submit">Place Order</button>
        </div>
      </form>

      <?php if (isset($_POST['submit']) && $error == ""): ?>
        <div class="receipt">
          <h3>Receipt</h3>
          <p><b>Customer:</b> <?php echo htmlspecialchars($name); ?></p>
          <p>
            <b>Order:</b>
            <?php echo htmlspecialchars($drink); ?>
            (<?php echo htmlspecialchars($size); ?>)
            <?php echo $isIced ? "(Iced)" : "(Hot)"; ?>
          </p>
          <p><b>Quantity:</b> <?php echo $qty; ?></p>
          <p><b>Price Each:</b> $<?php echo $price; ?></p>
          <p><b>Total:</b> $<?php echo $total; ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>