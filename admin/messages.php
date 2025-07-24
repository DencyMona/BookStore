
<?php
session_start();
require '../config.php';
if (isset($_GET['testimonial'])) {
    // your logic...
    // header("Location: messages.php?toast=testimonial_added");
    die("Redirect trigger reached");
  }
  
// Handle delete action
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $pdo->query("DELETE FROM messages WHERE id = $id");
  echo "<p style='color: green;'>Message deleted successfully.</p>";
}

// Handle add-to-testimonial action
if (isset($_GET['testimonial'])) {
  $id = intval($_GET['testimonial']);
  $msg = $pdo->query("SELECT * FROM messages WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

  if ($msg) {
    $name = $msg['name'];
    $message = $msg['message'];
    $pdo->query("INSERT INTO testimonials (name, message, approved) VALUES ('$name', '$message', 1)");
    echo "<p style='color: green;'>Added to testimonials.</p>";
}

}

// Fetch all messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Messages</title>
  <link rel="stylesheet" href="dashboard.css">
  <style>
.message-box {
  background: #fefefe;
  border: 1px solid #ddd;
  border-left: 5px solid #2563eb;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  transition: box-shadow 0.3s ease;
}

.message-box:hover {
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}

.message-box strong {
  display: block;
  font-size: 18px;
  color: #2563eb;
  margin-bottom: 6px;
}

.message-box p {
  margin: 8px 0 12px;
  font-size: 15px;
  color: #333;
  line-height: 1.5;
}
.admin-buttons {
  margin-top: 10px;
}

.admin-buttons a {
  display: inline-block;
  padding: 8px 14px;
  margin-right: 10px;
  background-color: #2563eb;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  font-size: 14px;
  transition: background-color 0.2s ease;
}

.admin-buttons a:hover {
  background-color: #1e40af;
}
  </style>
</head>
<body>

<?php if (isset($_GET['toast']) && $_GET['toast'] === 'testimonial_added'):?>
  <div class="toast-success">✅ Testimonial added successfully!</div>
<?php endif;?>


  <h2>User Messages</h2>

  <?php while ($msg = $messages->fetch(PDO::FETCH_ASSOC)):?>
    <div class="message-box">
      <strong><?= htmlspecialchars($msg['name'])?></strong> (<?= htmlspecialchars($msg['email'])?>)
      <p><?= nl2br(htmlspecialchars($msg['message']))?></p>

      <div class="admin-buttons">
        <a href="messages.php?delete=<?= $msg['id']?>" onclick="return confirm('Delete this message?')">🗑 Delete</a>
        <a href="messages.php?testimonial=<?= $msg['id']?>">➕ Add to Testimonials</a>
      </div>
    </div>
  <?php endwhile;?>

</body>
</html>
