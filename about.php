<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Shop</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="story-intro">
    <div class="white-heading">
      <h2>The Story Behind Our Stories</h2>
      <p>We believe comics should be thrilling, affordable, and easy to find.</p>
    </div>

    <div class="yellow-box">
      <div class="yellow-text">
        <p>
          We believe that great stories should be accessible to everyone. Our mission is to bring exciting, affordable comics to readers in a diverse range of voices and perspectives.
        </p>
        <a href="#" class="learn-button">Learn More</a>
      </div>
      <div class="yellow-image">
        <img src="images/about.jpg" alt="My BIG Welcome Cover">
      </div>
    </div>
  </section>

  
  <section class="why-choose">
    <h2>Why Choose Us?</h2>
    <p class="section-tagline">and excitement crafted to keep readers of all ages engaged.</p>
    <div class="choose-grid">
      <div class="choose-card">
        <div class="number-box">1</div>
        <h3>Affordable and Accessible</h3>
        <p>Enjoy high-quality comics at budget-friendly prices, available online anytime, anywhere. No subscriptions, no hassle.</p>
      </div>
      <div class="choose-card">
        <div class="number-box">2</div>
        <h3>Perfect for Parents & Kids</h3>
        <p>Explore family-friendly stories that spark imagination and curiosity, making reading fun and enriching experiences.</p>
      </div>
      <div class="choose-card">
        <div class="number-box">3</div>
        <h3>Designed for the Digital Age</h3>
        <p>Experience crisp visuals, smooth navigation, and a reading experience optimized for all devices.</p>
      </div>
    </div>
  </section>

  <?php
include 'includes/db.php'; // or your database connection file

// Fetch approved testimonials
$result = mysqli_query($conn, "SELECT * FROM testimonials WHERE approved = 1 ORDER BY created_at DESC");
?>

<div class="testimonials-section">
  <h2>What Readers Say</h2>
  <?php while ($row = mysqli_fetch_assoc($result)):?>
    <div class="testimonial">
      <h4><?php echo htmlspecialchars($row['name']);?></h4>
      <p><?php echo htmlspecialchars($row['message']);?></p>
    </div>
  <?php endwhile;?>
</div>
<style>
.testimonials-section {
  padding: 50px 30px;
  background: #fef9f4;
  text-align: center;
}

.testimonials-section h2 {
  font-size: 2.2em;
  font-family: 'Playfair Display', serif;
  margin-bottom: 30px;
  color: #2c3e50;
}

.testimonial {
  display: inline-block;
  width: 300px;
  margin: 0 10px 30px;
  padding: 20px 25px;
  background: #fff;
  border-left: 5px solid yellow;
  border-radius: 12px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease;
}

.testimonial:hover {
  transform: translateY(-6px);
}


.testimonial h4 {
  margin: 0 0 10px;
  font-size: 17px;
  font-weight: 600;
  color: green ;
}

.testimonial p {
  font-size: 15px;
  color: #444;
  font-style: italic;
  line-height: 1.6;
}

</style>
</body>
</html>