
<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username']?? '';
  $password = $_POST['password']?? '';

  // 1. Check for admin login
  if ($username === 'admin' && $password === 'admin123') {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin/dashboard.php");
    exit;
}

    try {
      $stmt = $pdo->prepare("SELECT * FROM users WHERE username =?");
      $stmt->execute([$username]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit;
    } else {
        $error = "Incorrect password.";
    
  }
  } catch (PDOException $e) {
      $error = "Database error: ". $e->getMessage();
  }
  }
  ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <style>
  body {
      background-color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
}
.login-box {
      background: #ffffff;
      padding: 2.5em 3em;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      color: #1C3A2E;
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
h2 {
      color: #1C3A2E;
      margin-bottom: 1.2em;
      font-size:2em;
}

    input {
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
.register-link {
      display: block;
      margin-top: 1em;
      color: #1C3A2E;
      text-decoration: underline;
}
.error {
      color: red;
      margin-bottom: 1em;
}
  </style>
</head>
<body>
<div class="login-border-wrapper">
  <div class="login-box">
    <h2>Login</h2>
    <?php if ($error):?><p class="error"><?php echo $error;?></p><?php endif;?>
          <form method="post">
          <input type="text" name="username" placeholder="Username" required
            value="<?= isset($_GET['username'])? htmlspecialchars($_GET['username']): ''?>">
            <input type="password" name="password" placeholder="Password" required />
            
            <button type="submit" class="btn">Login</button>
            <a href="register.php" class="register-link">New user? <br>Register here</a>
          </form>
      </div>
      </div>
  </div>
</body>
</html>
