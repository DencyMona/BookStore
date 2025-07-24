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


  <section class="hero">
    <h2>Read, explore, and<br>get lost in stories.</h2>
    <p>These books will haunt your thoughts, steal your sleep, and make you fall hard — again and again.
From Twisted Games to The Inmate and Powerless 
<br>— every page is pure obsession.
</p>
    <br>
    <a href="shop.php" class="cta-button">Visit Our Shop</a>
    <div class="book-covers">
      <img src="images/homeImg1.jpg" class="rotate-left" alt="Little Fox's Evening Adventure">
      <img src="images/homeImg2.jpg" class="rotate-straight" alt="Magical Nights">
      <img src="images/homeImg3.jpg" class="rotate-right" alt="Windy and the Worry Warts">
    </div>
  </section>

  <section class="story-intro">
    <div class="white-heading">
      <h2>The Story Behind Our Stories</h2>
      <p> Fall in love, feel the fear, get completely obsessed.</p>
    </div>

    <div class="yellow-box">
      <div class="yellow-text">
        <p>
        Now you can order any book, even those not available locally – bestsellers, classics, academic, or niche titles. Just send us the title or author and we’ll take care of the rest! 📲💬
        </p>
        <a href="about.php" class="learn-button">Learn More</a>
      </div>
      <div class="yellow-image">
        <img src="images/about.jpg" alt="My BIG Welcome Cover">
      </div>
    </div>
  </section>

  <section class="why-choose">
    <h2>Why Choose Us?</h2>
    <p class="section-tagline"> Once you start… you won’t stop.</p>
    <div class="choose-grid">
      <div class="choose-card">
        <div class="number-box">1</div>
        <h3>  Offers & Discounts </h3>
        <p><ul style="list-style-type: '✔ '; padding-left: 20px;">
    <li>2 Books – Rs 500 OFF</li>
    <li>3 Books – Rs 900 OFF</li>
    <li>4 Books – Rs 1300 OFF</li>
    <li>5 Books – Rs 1700 OFF</li>
    <li>🎧 Free audiobook with every purchase</li>
    <li>📖 Free bookmark with every order</li>
  </ul>
</p>
      </div>
      <div class="choose-card">
        <div class="number-box">2</div>
        <h3>  Delivery & Quality</h3>
        <p><ul style="list-style-type: '📦 '; padding-left: 20px;">
          <li>Free delivery islandwide – no minimum order</li>
          <li>Fast delivery – 2 days in Colombo, 3 days elsewhere</li>
          <li>100% brand new books</li>
          <li>Lowest prices guaranteed</li>
        </ul>
</p>
      </div>
      <div class="choose-card">
        <div class="number-box">3</div>
        <h3>Payment & Support</h3>
        <p><ul style="list-style-type: '💬 '; padding-left: 20px;">
    <li>Multiple payment options: Card, Bank Transfer, Cash on Delivery, Koko & Mintpay</li>
    <li>24/7 Customer Support + Order Tracking</li>
  </ul>
</p>
      </div>
    </div>
  </section>
  
<section class="exclusive-collections">
  <h2>Our Exclusive Collections</h2>
  <p class="section-intro">Can’t find the book you want ? We’ve got you covered!
</p>
  <div class="book-row">
    <?php
      $books = [
        ["The Jungle Book", "Rudyard Kipling", "1.49", "images/collImg6.jpg"],
        ["Alice in Wonderland", "Lewis Carrol", "3.49", "images/collImg7.jpg"],
        ["Black Beauty", "Anna Sewel", "5.99", "images/collImg8.jpg"],
        ["The Nativity", "Sophie Blake", "4.29", "images/collImg9.jpg"],
        ["Snowy Animals", "Billy", "3.00", "images/collImg10.jpg"],
        ["Magical Night", "Eliza Moon", "2.49", "images/collImg1.jpg"],
        ["Frozen Fever", "Aiden Frost", "3.99", "images/collImg2.jpg"],
        ["Wings of Fire", "Tui T. Sutherland", "1.99", "images/collImg3.jpg"],
        ["The Lost Planet", "Paul Dallas", "1.99", "images/collImg4.jpg"],
        ["Grimm's Fairy Tales", "Wilhelm Grimm", "1.99", "images/collImg5.jpg"]
      ];

    foreach ($books as $book) {
        [$title, $author, $price, $img] = $book;
    ?>
    <div class="book-card">
      <img src="<?= $img?>" alt="<?= htmlspecialchars($title)?>">
      <h3><?= htmlspecialchars($title)?></h3>
      <p class="author">by <?= htmlspecialchars($author)?></p>
      <p class="price">$<?= htmlspecialchars($price)?></p>
      <form method="post" action="cart.php">
        <input type="hidden" name="title" value="<?= htmlspecialchars($title)?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars($price)?>">
        <input type="hidden" name="image" value="<?= htmlspecialchars($img)?>">
        <button type="submit" class="cart-btn">Cart</button>
      </form>
    </div> <!-- end of.book-card -->
    <?php }?> <!-- end of foreach -->

  </div>
  <div class="shop-button-wrapper">
  <a href="shop.php" class="cta-button">View More</a>
  </div>
</section>

  <section class="countdown-section">
  <div class="section-head">
  <h2>Your Next Favorite Comic Awaits</h2>
   <p class="section-subtitle">⏳ Stock is flying. Message us now before they’re gone.</p>
   </div>
<div class="countdown-wrapper">
      <div class="countdown-layout">
        <img src="images/new.jpg" alt="Finally Seen Comic Cover" class="countdown-image" />
<div class="countdown-content">
  <h4 class="section-label">Finally Seen</h4>
  <p class="countdown-description">
    A young girl vanishes without a trace... and returns years later with no memory of where she's been—or who she truly is....
  </p>
          <div class="countdown-box">
            <div class="countdown-timer">
              <div><span id="days">00</span><p>Days</p></div>
              <div><span id="hours">00</span><p>Hours</p></div>
              <div><span id="minutes">00</span><p>Minutes</p></div>
              <div><span id="seconds">00</span><p>Seconds</p></div>
            </div>
            <BR>
            <a href="order.php" class="register-btn">Register Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="footer-columns">
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="home.php">home</a></li>
          <li><a href="about.php">about</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="#">Testimonials</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Extra Links</h4>
        <ul>
        <li><a href="index.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="order.php">Orders</a></li>
          <li><a href="#">Cart</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Contact Info</h4>
        <ul>
          <li><a href="#">0771234567</a></li>
          <li><a href="#">0779876543</a></li>
          <li><a href="#">books@gmail.com</a></li>
          <li><a href="#"> 12,mainstreet,Colombo</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Follow Us</h4>
        <ul class="social-icons">
          <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
          <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>
      </div>
      <div class="footer-gallery">
        <img src="images/footer1.jpg" alt="Book Cover 1">
        <img src="images/footer2.jpg" alt="Book Cover 2">
        <img src="images/footer3.jpg" alt="Book Cover 3">
      </div>

      <div class="footer-note">
        <p>© Evans Bookworms, <?php echo date("Y");?>. All rights reserved.</p>
      </div>
  </footer>
<script src="js/script.js"></script>
</body>
</html>
