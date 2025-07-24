
<?php
session_start();
require '../config.php'; // Update path if needed

// 🔐 Admin login check
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: index.php");
  exit;
}

// 📥 Fetch orders
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Orders</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9fafe;
      color: #1C3A2E;
      padding: 40px;
}

    h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 30px;
      border-left: 5px solid #f5d75e;
      padding-left: 12px;
}

    table {
      width: 100%;
      max-width: 960px;
      margin: auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
      border-radius: 10px;
      overflow: hidden;
}

    th, td {
      padding: 1em;
      text-align: left;
      border-bottom: 1px solid #eee;
}

    th {
      background-color: #f5d75e;
      color: #1C3A2E;
}

.status {
      font-weight: bold;
      color: #1C3A2E;
}

.book-list {
      font-size: 14px;
      line-height: 1.5em;
      color: #444;
}

.back-link {
      display: block;
      text-align: center;
      margin-top: 30px;
      font-weight: bold;
      color: #1C3A2E;
      text-decoration: none;
}

.back-link:hover {
      text-decoration: underline;
}
  </style>
</head>
<body>

  <h2>🧾 Order Management Dashboard</h2>

  <table>
    <tr>
      <th>#</th>
      <th>Customer</th>
      <th>Email</th>
      <th>Delivery Date</th>
      <th>Books Ordered</th>
      <th>Total</th>
      <th>Payment</th>
      <th>Status</th>
    </tr>
    <?php foreach ($orders as $i => $order):?>
    <tr>
      <td><?= $i + 1?></td>
      <td><?= htmlspecialchars($order['name'])?></td>
      <td><?= htmlspecialchars($order['email'])?></td>
      <td><?= htmlspecialchars($order['delivery_date'])?></td>
      <td class="book-list">
        <?php
          $items = json_decode($order['items'], true);
          if (is_array($items)) {
            foreach ($items as $book) {
              echo "- ". htmlspecialchars($book['title']). "<br>";
}
} else {
            echo "No book data";
}
?>
      </td>
      <td>Rs <?= htmlspecialchars($order['grand_total'])?></td>
      <td><?= ucfirst(htmlspecialchars($order['payment_method']))?></td>
      <td class="status"><?= htmlspecialchars($order['status']?? 'Pending')?></td>
    </tr>
    <?php endforeach;?>
  </table>

  <a href="dashboard.php" class="back-link">← Back to Dashboard</a>

</body>
</html>
