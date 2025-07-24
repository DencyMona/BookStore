<?php
session_start();
require 'config.php'; // contains $pdo connection

$cart = $_SESSION['cart']?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $delivery_date = $_POST['delivery_date'];
  $payment_method = $_POST['payment_method'];

  // Cart calculations
  $total = 0;
  $count = count($cart);
  foreach ($cart as $item) {
    $total += (float)$item['price'];
}

  $discount = 0;
  if ($count === 2) $discount = 500;
  elseif ($count === 3) $discount = 900;
  elseif ($count === 4) $discount = 1300;
  elseif ($count>= 5) $discount = 1700;

  $grandTotal = $total - $discount;

  // Convert cart items to JSON string
  $items_json = json_encode($cart);
  // Save to database
  $stmt = $pdo->prepare("INSERT INTO orders
    (name, email, address, delivery_date, payment_method, items, total_price, discount, grand_total)
    VALUES (?,?,?,?,?,?,?,?,?)");
  $stmt->execute([$name, $email, $address, $delivery_date, $payment_method, $items_json, $total, $discount, $grandTotal]);

  // Clear cart
  unset($_SESSION['cart']);

  // Fetch order ID (optional for display)
  $order_id = $pdo->lastInsertId();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f9fafe;
      padding: 40px;
      color: #1C3A2E;
}
.confirmation-box {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border: 2px solid #1C3A2E;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
}
    h2 {
      border-left: 5px solid #f5d75e;
      padding-left: 12px;
      margin-bottom: 20px;
}
.info-line {
      margin: 8px 0;
      font-size: 15px;
}
  </style>
</head>
<body>
<div class="confirmation-box">
    <h2>🎉 Order Confirmed!</h2>
    <div class="info-line">🧾 Order ID: <?= $order_id?></div>
    <div class="info-line">👤 Name: <?= htmlspecialchars($name)?></div>
    <div class="info-line">📧 Email: <?= htmlspecialchars($email)?></div>
    <div class="info-line">🏡 Address: <?= htmlspecialchars($address)?></div>
    <div class="info-line">📅 Delivery Date: <?= $delivery_date?></div>
    <div class="info-line">💳 Payment Method: <?= ucfirst($payment_method)?></div>
    <div class="info-line">📚 Items Ordered: <?= $count?> books</div>
    <div class="info-line">💰 Subtotal: Rs <?= $total?></div>
    <div class="info-line">🎁 Discount: Rs <?= $discount?></div>
    <div class="info-line"><strong>🧾 Grand Total: Rs <?= $grandTotal?></strong></div>
    <div class="info-line">🎧 You'll receive a free audiobook and bookmark with this order!</div>
  </div>
</body>
</html>
