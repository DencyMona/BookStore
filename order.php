
<?php
session_start();
$cart = $_SESSION['cart']?? [];
$total = 0;
$count = count($cart);
foreach ($cart as $item) {
  $total += (float) $item['price'];
}

// 🎁 Apply Book-Based Discounts
$discount = 0;
if ($count === 2) $discount = 500;
elseif ($count === 3) $discount = 900;
elseif ($count === 4) $discount = 1300;
elseif ($count>= 5) $discount = 1700;

$grandTotal = $total - $discount;
?>
<div class="order-wrapper">
        <div class="order-form">
        <h2>Grab the Deal</h2>
        <form method="post" action="confirm_order.php">
          <label>Name:</label>
          <input type="text" name="name" required><br>

          <label>Email:</label>
          <input type="email" name="email" required><br>

          <label>Home Address:</label>
          <textarea name="address" required></textarea><br>

          <label>Delivery Date:</label>
          <input type="date" name="delivery_date" required><br>

          <label>Payment Method:</label><br>
          <select name="payment_method" required>
            <option value="card">Card</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="cod">Cash on Delivery</option>
            <option value="mintpay">MintPay</option>
            <option value="koko">Koko</option>
          </select><br>
          
        </div>
  
        <div class="order-summary">
          <h3>🧮 Order Summary</h3>
          <div class="summary-line">📚Books in Cart: 3</div>
          <div class="summary-line">💰Subtotal: Rs 9.27</div>
          <div class="summary-line">🎁Discount: Rs 900</div>
          <div class="summary-bold">🧾Grand Total: Rs -890.73</div>
          <p>🎧 Free audiobook with every purchase</p>
          <p>📖 Free bookmark with every order</p>
          <button class="confirm-btn">Confirm Order</button>
        </div>
      </div>
</form>
<style>
 
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background-color: #f9fafe;
  color: #1C3A2E;
  display: flex;
  justify-content: center;
  padding: 10px 20px;

}
.order-wrapper {
  display: flex;
  flex-wrap: wrap;
  max-width: 960px;
  width: 100%;
  gap: 30px;
  background: #fff;
  padding: 30px 40px;
  border-radius: 14px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  border: 2px solid #1C3A2E;
}
.order-form {
  flex: 1;
  min-width: 260px;
}

.order-form h2 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #1C3A2E;
  border-left: 5px solid #f5d75e;
  padding-left: 12px;
}

.order-form label {
  display: block;
  font-weight: bold;
  margin-bottom: 6px;
}

.order-form input[type="text"],
.order-form input[type="email"],
.order-form input[type="date"],
.order-form textarea,
.order-form select {
  width: 100%;
  padding: 10px 12px;
  border: 2px solid #1C3A2E;
  border-radius: 6px;
  margin-bottom: 16px;
  font-size: 14px;
}
.order-summary {
  flex: 1;
  min-width: 260px;
  border-left: 2px solid #1C3A2E;
  padding-left: 30px;
}

.order-summary h3 {
  font-size: 20px;
  margin-bottom: 16px;
  color: #1C3A2E;
}

.summary-line {
  font-size: 15px;
  margin: 8px 0;
}

.summary-bold {
  font-weight: bold;
  font-size: 16px;
  margin-top: 12px;
  color: #1C3A2E;
}

.order-summary p {
  font-size: 14px;
  color: #555;
  margin: 6px 0;
}
.confirm-btn {
  display: block;
  background-color: #f5d75e;
  color: #1C3A2E;
  font-weight: bold;
  font-size: 16px;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

.confirm-btn:hover {
  background-color: #1C3A2E;
  color: #f5d75e;
}

</style>