
<?php
session_start();
require '../config.php'; // ✅ Include the PDO connection

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: index.php");
  exit;
}

// Handle Add
if (isset($_POST['add'])) {
  $stmt = $pdo->prepare("INSERT INTO books (title, author, price) VALUES (?,?,?)");
  $stmt->execute([$_POST['title'], $_POST['author'], $_POST['price']]);
  header("Location: books.php");
  exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
  $stmt = $pdo->prepare("DELETE FROM books WHERE id =?");
  $stmt->execute([$_GET['delete']]);
  header("Location: books.php");
  exit;
}

// Handle Edit
$editBook = null;
if (isset($_GET['edit'])) {
  $stmt = $pdo->prepare("SELECT * FROM books WHERE id =?");
  $stmt->execute([$_GET['edit']]);
  $editBook = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle Update
if (isset($_POST['update'])) {
  $stmt = $pdo->prepare("UPDATE books SET title =?, author =?, price =? WHERE id =?");
  $stmt->execute([$_POST['title'], $_POST['author'], $_POST['price'], $_POST['edit_id']]);
  header("Location: books.php");
  exit;
}
if (isset($_POST['add'])) {
  $imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
  $uploadDir = 'uploads/';
  $imageName = time(). '_'. basename($_FILES['image']['name']);
  $imagePath = $uploadDir. $imageName;
  move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}

  $stmt = $pdo->prepare("INSERT INTO books (title, author, price, image) VALUES (?,?,?,?)");
  $stmt->execute([$_POST['title'], $_POST['author'], $_POST['price'], $imagePath]);
  header("Location: books.php");
  exit;
}


// Fetch all books
$stmt = $pdo->query("SELECT * FROM books ORDER BY id ASC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Books</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      color: #1C3A2E;
      padding: 2em;
}
    h2 {
      text-align: center;
      color: #1C3A2E;
}
    form {
      background: #ffffff;
      padding: 1.5em;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      max-width: 500px;
      margin: 2em auto;
}
    input {
      width: 100%;
      padding: 0.75em;
      margin: 0.5em 0;
      border: 1px solid #ccc;
      border-radius: 6px;
}
    button {
      background-color: #1C3A2E;
      color: #f5d75e;
      font-weight: bold;
      border: none;
      padding: 0.75em;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      margin-top: 0.5em;
}
    table {
      width: 100%;
      max-width: 900px;
      margin: 2em auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 4px 16px rgba(0,0,0,0.06);
      border-radius: 8px;
}
    th {
      background: #f5d75e;
      color: #1C3A2E;
      padding: 1em;
      text-align: left;
}
    td {
      padding: 0.9em 1em;
      border-bottom: 1px solid #eee;
}
.actions a {
      margin-right: 1em;
      text-decoration: none;
      color: #1C3A2E;
      font-weight: bold;
}
.actions a:hover {
      text-decoration: underline;
}
.delete-link {
      color: red;
}
.back {
      text-align: center;
      margin-top: 2em;
}
.back a {
      color: #1C3A2E;
      text-decoration: none;
      font-weight: bold;
}
  </style>
</head>
<body>

  <h2><?= $editBook? 'Edit Book': 'Add New Book'?></h2>

  <form method="post"enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Book Title" required value="<?= $editBook? htmlspecialchars($editBook['title']): ''?>">
    <input type="text" name="author" placeholder="Author Name" required value="<?= $editBook? htmlspecialchars($editBook['author']): ''?>">
    <input type="text" name="price" placeholder="Price (e.g. 4.99)" required value="<?= $editBook? htmlspecialchars($editBook['price']): ''?>">
    <input type="file" name="image" accept="image/*" <?= $editBook? '': 'required'?>>
    

    <?php if ($editBook):?>
      <input type="hidden" name="edit_id" value="<?= $editBook['id']?>">
      <button type="submit" name="update">Update Book</button>
    <?php else:?>
      <button type="submit" name="add">Add Book</button>
    <?php endif;?>
  </form>

  
<div style="display:flex; flex-wrap:wrap; justify-content:center; gap:2em;">
  <?php foreach ($books as $book):?>
    <div style="width:200px; text-align:center; background:#fff; padding:1em; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.1); position:relative;">

      <!-- Book Cover -->
      <?php if (!empty($book['image'])):?>
        <img src="<?= htmlspecialchars($book['image'])?>" alt="Book Cover"
             style="width:120px; height:180px; object-fit:cover; border-radius:6px; margin-bottom:0.5em;">
      <?php else:?>
        <div style="width:120px; height:180px; background:#ccc; display:flex; align-items:center; justify-content:center; margin:auto; border-radius:6px;">
          <span>No Image</span>
        </div>
      <?php endif;?>

      <!-- Title & Details -->
      <h4 style="margin:0.5em 0 0.2em;"><?= htmlspecialchars($book['title'])?></h4>
      <p style="margin:0.2em 0; font-style:italic; font-size:0.9em;">By <?= htmlspecialchars($book['author'])?></p>
      <p style="margin:0.2em 0; font-weight:bold;">$<?= htmlspecialchars($book['price'])?></p>

      <!-- Action Buttons -->
      <div style="margin-top:0.8em; display:flex; justify-content:center; gap:0.5em;">
        <a href="?edit=<?= $book['id']?>" style="background:#1C3A2E; color:#f5d75e; padding:0.4em 0.8em; border-radius:5px; text-decoration:none; font-size:0.85em;">Edit</a>
        <a href="?delete=<?= $book['id']?>" class="delete-link" style="background:#cc0000; color:#fff; padding:0.4em 0.8em; border-radius:5px; text-decoration:none; font-size:0.85em;">Delete</a>
      </div>

    </div>
  <?php endforeach;?>
</div>



  <div class="back">
    <a href="dashboard.php">← Back to Dashboard</a>
  </div>

</body>
</html>
