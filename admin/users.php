
<?php
session_start();
require '../config.php'; // adjust path as needed

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: index.php");
  exit;
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
}
.header {
      background-color: #1C3A2E;
      color: #f5d75e;
      padding: 1.5em 2em;
      text-align: center;
}
.users-table {
      width: 90%;
      margin: 2em auto;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}
.users-table th {
      background-color: #f5d75e;
      color: #1C3A2E;
      padding: 1em;
      text-align: left;
}
.users-table td {
      padding: 1em;
      border-top: 1px solid #ddd;
}
.users-table tr:hover {
      background-color: #f0f0f0;
}
.back-link {
      display: block;
      margin: 1.5em auto;
      text-align: center;
      color: #1C3A2E;
      text-decoration: none;
      font-weight: bold;
}
  </style>
</head>
<body>

  <div class="header">
    <h2>User Management</h2>
  </div>

  <table class="users-table">
    <tr>
      <th>User ID</th>
      <th>Full Name</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
    <?php foreach ($users as $user):?>
    <tr>
      <td><?= htmlspecialchars($user['id'])?></td>
      <td><?= htmlspecialchars($user['fullname'])?></td>
      <td><?= htmlspecialchars($user['username'])?></td>
      <td><?= htmlspecialchars($user['email'])?></td>
      <td><?= ucfirst(htmlspecialchars($user['role']))?></td>
    </tr>
    <?php endforeach;?>
  </table>

  <a href="dashboard.php" class="back-link">← Back to Dashboard</a>

</body>
</html>
