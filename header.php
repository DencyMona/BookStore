<?php
 session_start();
 $cartCount = isset($_SESSION['cart'])? count($_SESSION['cart']): 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dreamland</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="css/style.css">
  <title>Book Store</title>

</head>
<body>
  <header>
    <nav>
      <h1>DreamLand 📚</h1>
      <ul>
      <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="shop.php">Collections</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    
      <div class="navbar">
      <a href="#" class="nav-icon">🔍</a> <!-- search icon only -->
      <a href="#" class="nav-icon">👤</a> <!-- user/account -->
      <a href="cart.php" class="nav-icon">🛒 <span class="cart-count">(<?= $cartCount?>)</span></a>
      <a href="logout.php" class="login-btn">🔓</a>

      </div>
    </nav>
  </header>
  <script src="js/script.js"></script>
</body>
</html>