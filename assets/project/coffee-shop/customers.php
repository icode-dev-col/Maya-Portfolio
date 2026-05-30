<?php
/* ==========================================================
   customers.php
   Customer List + Search Filter
   ========================================================== */

$customers = [
  ["id" => 1, "name" => "Mia Lopez", "favorite" => "Latte"],
  ["id" => 2, "name" => "Ethan Kim", "favorite" => "Americano"],
  ["id" => 3, "name" => "Ava Patel", "favorite" => "Hot Chocolate"],
  ["id" => 4, "name" => "Noah Chen", "favorite" => "Mocha"],
  ["id" => 5, "name" => "Sofia Brown", "favorite" => "Cappuccino"],
  ["id" => 6, "name" => "Lucas Green", "favorite" => "Iced Coffee"]
];

$q = trim($_GET['q'] ?? "");
$qLower = strtolower($q);
$matchCount = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Customers - Robert's Coffee Shop</title>
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
      <h2>Customer List</h2>
      <p>Search by customer name or favorite drink.</p>

      <form method="GET" action="">
        <label>Search</label>
        <input
          type="text"
          name="q"
          placeholder="Try: mia or mocha"
          value="<?php echo htmlspecialchars($q); ?>"
        />
        <button type="submit">Search</button>
      </form>
    </div>

    <div class="card">
      <p><b>Searching for:</b> <?php echo $q == "" ? "All customers" : htmlspecialchars($q); ?></p>

      <div class="customer-list">
        <?php
        foreach ($customers as $c) {
          $text = strtolower($c["name"] . " " . $c["favorite"]);

          $show = false;
          if ($qLower == "") {
            $show = true;
          } else {
            $show = (strpos($text, $qLower) !== false);
          }

          if ($show) {
            $matchCount++;
            ?>
            <div class="customer-row">
              <div class="customer-info">
                <b><?php echo htmlspecialchars($c["name"]); ?></b><br>
                <small>Favorite Drink: <?php echo htmlspecialchars($c["favorite"]); ?></small>
              </div>
              <div class="badge">ID: <?php echo $c["id"]; ?></div>
            </div>
            <?php
          }
        }

        if ($matchCount === 0) {
          echo '<div class="empty">No customers matched your search.</div>';
        }
        ?>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>