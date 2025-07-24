<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Dream Land</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fefbe9;
      color: #333;
    }
    .contact-section {
      display: flex;
      flex-wrap: wrap;
      max-width: 1000px;
      margin: auto;
      padding: 40px;
      background: #ffffff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    .contact-info {
      flex: 1;
      padding: 20px;
      background: #d4f4dd;
      border-radius: 10px 0 0 10px;
    }
    .contact-info h2 {
      
      margin-bottom: 0.5em;
      color:#2c3e50; 
      text-align: center; 
      font-size: 2.5em;
      font-family: 'Playfair Display', serif;
    }
    .contact-info p {
      margin: 10px 0;
    }
    .contact-info a {
      color: #388e3c;
      text-decoration: none;
    }
    .contact-form {
      flex: 1;
      padding: 30px;
      background: #fffde7;
      border-radius: 0 10px 10px 0;
    }
    .contact-form h2 {
      color:#f9a825;
      text-align: center; 
      font-size: 1.5em;
      font-family: 'Playfair Display', serif;
    }
    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #fffff3;
    }
    .contact-form button {
      background: #fbc02d;
      color: #000;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .contact-form button:hover {
      background: #f9a825;
    }
  </style>
</head>
<body>

<section class="contact-section">

  <div class="contact-info">
    
    <h2 >Get in Touch</h2>
    <p>Got questions? We’d love to hear from you.</p>
    <p>📧 dreamlandbooks@gmail.com</p>
    <p>📞 ‪+94 712 345 678‬</p>
    <p>💬 <a href="#">Chat on WhatsApp</a></p>
    <p><ul class="social-icons">
          <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
          <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
        </ul></p>
    <br>
  </div>

  <div class="contact-form">
    <h2>Leave a Message</h2>
    <form action="send.php" method="post">
      <label>Your Name</label>
      <input type="text" name="name" required>

      <label>Your Email</label>
      <input type="email" name="email" required>

      <label>Your Message</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>

</section>

</body>
</html>
