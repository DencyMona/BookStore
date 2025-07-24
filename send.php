<?php
include 'includes/db.php'; // Make sure this file sets $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Optional: show success or redirect
    header("Location: thank_you.html");
    exit();
} else {
    echo "Failed to send message.";
}
}
?>
