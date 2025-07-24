<?php
session_start();
require 'config.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname']?? '';
  $email    = $_POST['email']?? '';
  $username = $_POST['username']?? '';
  $password = $_POST['password']?? '';
  $role     = $_POST['role']?? 'user';

  // Input validation
  if (!$fullname ||!$email ||!$username ||!$password) {
    $error = "Please fill in all fields.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
} elseif (strlen($password) < 6) {
    $error = "Password must be at least 6 characters long.";
} else {
    // All good — proceed with insert
    $hash = password_hash($password, PASSWORD_DEFAULT);
    try {
      $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password, role) VALUES (?,?,?,?,?)");
      $stmt->execute([$fullname, $email, $username, $hash, $role]);
      $success = "Registration successful! You can now log in.";
      header("Location: index.php?username=". urlencode($username));
      exit;
      } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
              $error = "Username or email already exists.";
      } else {
              $error = "Registration failed: ". $e->getMessage();
      }
      }
      }
      }
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Registration</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
}
.register-box {
      background: #ffffff;
      padding: 2.5em 3em;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 420px;
      text-align: center;
      color: #1C3A2E;
}
    h2 {
      color: #1C3A2E;
      margin-bottom: 1.2em;
}

.login-border-wrapper {
  position: relative;
  padding: 5px;
  background: transparent;
  border-radius: 14px;
  animation: border-run 3s linear infinite;
}

.login-border-wrapper::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  border: 2px solid #1C3A2E;
  border-radius: 14px;
  box-sizing: border-box;
  animation: line-animate 4s ease-in-out infinite;
}

@keyframes line-animate {
  0% {
    clip-path: inset(0 100% 100% 0);
}
  25% {
    clip-path: inset(0 0 100% 0);
}
50% {
    clip-path: inset(0 0 0 0);
}
  75% {
    clip-path: inset(100% 0 0 0);
}
  100% {
    clip-path: inset(0 100% 100% 0);
}
}
input, select {
      width: 100%;
      padding: 0.75em;
      margin: 0.5em 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1em;
}
.btn {
      background-color: #1C3A2E;
      color: #f5d75e;
      padding: 0.75em;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1em;
}
.btn:hover {
      background-color: #163226;
}
.error {
      color: red;
      font-weight: bold;
      margin-top: 1em;
}
  </style>
</head>
<body>
<div class="login-border-wrapper">
      <div class="login-box">
  <div class="register-box">
    <h2>Create Your Account</h2>
    <?php if ($error):?>
      <div class="error"><?= htmlspecialchars($error)?></div>
    <?php endif;?>
    <form method="post">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="text" name="username" placeholder="Choose a Username" required />
      <input type="password" name="password" placeholder="Create a Password" required />
      <select name="role" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
      </select>
      <button type="submit" class="btn">Register</button>
      <p> already have an account?<a href="index.php">Login now</a></p>
    </form>
    </div>
      </div>
  </div>
</body>
</html>