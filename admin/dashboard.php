<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location:index.php");
  exit;
}

$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalBooks = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();
$pendingOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$newMessages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<nav class="sidebar">
    <h2>📚 Admin Panel</h2>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="users.php">Manage Users</a></li>
      <li><a href="books.php">Manage Books</a></li>
      <li><a href="orders.php">Orders</a></li>
      <li><a href="messages.php">Messages</a></li>

    </ul>
  </nav>

  <main class="main-content">
    <header class="header">
      <h1>📊 Dashboard Overview</h1>
      <div class="admin-tools">
        <span>👋 Welcome, Admin</span>
        <a href="../logout.php" class="logout-btn">Logout</a>
      </div>
    </header>

    <section class="dashboard-widgets">
      <article class="widget"><h3>Total Users</h3><p><?= $totalUsers?></p></article>
      <article class="widget"><h3>Total Books</h3><p><?= $totalBooks?></p></article>
      <article class="widget"><h3>Pending Orders</h3><p><?= $pendingOrders?></p></article>
      <article class="widget"><h3>New Messages</h3><p><?= $newMessages?></p></article>
    </section>
  </main>

</body>
</html>

