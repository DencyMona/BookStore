
<?php
session_start();
if (isset($_GET['remove'])) {
  $index = (int) $_GET['remove'];
  if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
}
}

 // 🛒 Grab current cart items
$cart = $_SESSION['cart']?? [];

// ➕ Handle incoming new cart item via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['price'], $_POST['image'])) {
  $item = [
    'title' => $_POST['title'],
    'price' => $_POST['price'],
    'image' => $_POST['image']
  ];
  $_SESSION['cart'][] = $item;
  $cart = $_SESSION['cart']; // refresh cart after update
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      color: #1C3A2E;
      padding: 2em;
}

    h1 {
      text-align: center;
      font-size: 2em;
      margin-bottom: 1em;
}

.cart-container {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5em;
      justify-content: center;
      margin-bottom: 2em;
}

.cart-item {
      background-color: #fff;
      border-left: 6px solid #f5d75e;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 1em;
      max-width: 300px;
      text-align: center;
}

.cart-item img {
    max-width: 150px;
  max-height: 180px;
  height: auto;
  width: auto;
  border-radius: 6px;
  margin-bottom: 0.5em;

}

.cart-item h3 {
      margin-top: 0.5em;
      font-size: 1.2em;
}

.cart-item.price {
      font-size: 1.4em;
      font-weight: bold;
      margin: 0.5em 0;
}

.order-section {
      text-align: center;
}

.order-btn {
      background-color: #f5d75e;
      color: #1C3A2E;
      font-weight: bold;
      padding: 0.8em 1.6em;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-size: 1em;
}

.order-btn:hover {
      background-color: #e6c746;
}
.delete-btn {
  background-color: #f5d75e;
  color: #1C3A2E;
  font-weight: bold;
  padding: 0.5em 1em;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.delete-btn:hover {
  background-color: #e6c746;
}


.empty {
      text-align: center;
      font-size: 1.2em;
      margin-top: 3em;
      color: #999;
}
  </style>
</head>
<body>

  <h1>🛒 Your Shopping Cart</h1>

  <?php if (!empty($cart)):?>
    <div class="cart-container">
    <?php foreach ($cart as $index => $item):?>
        <div class="cart-item">
          <img src="<?= htmlspecialchars($item['image'])?>" alt="<?= htmlspecialchars($item['title'])?>">
          <h3><?= htmlspecialchars($item['title'])?></h3>
          <p class="price">$<?= htmlspecialchars($item['price'])?></p>
        <!-- 🗑 Remove button -->
          <form method="get" style="margin-top: 0.5em;">
        <input type="hidden" name="remove" value="<?= $index?>">
        <button type="submit" class="delete-btn">Remove</button>
      </form>

      </div>
    <?php endforeach;?>
  </div>

  <div class="order-section">
    <form method="post" action="order.php">
      <?php foreach ($cart as $item):?>
        <input type="hidden" name="items[]" value="<?= htmlspecialchars(json_encode($item))?>">
      <?php endforeach;?>
      <button type="submit" class="order-btn">Proceed to Order</button>
    </form>
  </div>
<?php else:?>
  <p class="empty">Your cart is empty. Start adding your favorite books!</p>
<?php endif;?>

</body>
</html>

