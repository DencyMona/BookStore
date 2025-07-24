
<?php

include 'header.php';

// Categories and Sample Books
$categories = array(
  "Romance", "Fantasy", "Thriller & Mystery", "Novels",
  "New Arrivals", "Personal Development", "Business", "Motivation"
);

$sampleBooks = array(
  "The Jungle Book", "Atomic Habits", "It Ends with Us", "Rich Dad Poor Dad",
  "The Power of Now", "Ugly Love", "Think Like a Monk", "Verity"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop | Dream Land</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f9fafe;
      color: #1f2937;
}

    h2 {
      margin: 40px 20px 10px;
      font-size: 24px;
      color:#1C3A2E;
      border-left: 4px solid #1C3A2E;
      padding-left: 12px;
}

.category {
      padding: 20px 40px;
}

.books {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 24px;
      margin-top: 20px;
}

.book-card {
      background: #ffffff;
      border: 2px solid #018d55;
      border-radius: 14px;
      padding: 16px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
}

.book-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      border: 1px solid black;
}

.book-title {
      margin-top: 12px;
      font-size: 18px;
      font-weight: bold;
      color: #227051;
}

.book-price {
      font-size: 15px;
      color: #1C3A2E;
      margin: 6px 0;
}

.book-description {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
}

.book-cart-btn {
      padding: 8px 12px;
      font-size: 14px;
      color: black;
      background-color: #f5d75e;
      border: none;
      border-radius: 6px;
      cursor: pointer;
}

.book-cart-btn:hover {
      background-color:#1C3A2E;
      color: white;
}

    form {
      margin-top: 10px;
}
  </style>
</head>
<body>

<?php foreach ($categories as $category):?>
  <div class="category">
    <h2><?php echo $category;?></h2>
    <div class="books">
      <?php for ($i = 0; $i < 8; $i++):?>
        <div class="book-card">
          <?php
            $title = $sampleBooks[$i % count($sampleBooks)];
            $price = 1.49;
            $image = "https://via.placeholder.com/200x220?text=Book+1". ($i + 1);
?>
          <img src="<?php echo $image;?>" alt="Book Image">
          <div class="book-title"><?php echo $title;?></div>
          <div class="book-price">$<?php echo $price;?></div>
          <div class="book-description">A short preview or tagline for this book.</div>

          <form method="post" action="cart.php">
            <input type="hidden" name="title" value="<?php echo $title;?>">
            <input type="hidden" name="price" value="<?php echo $price;?>">
            <input type="hidden" name="image" value="<?php echo $image;?>">
            <button type="submit" class="book-cart-btn">Cart</button>
          </form>
        </div>
      <?php endfor;?>
    </div>
  </div>
<?php endforeach;?>

</body>
</html>

