<?php

include 'includes/db.php';
include 'includes/session.php';
$message = ''; // Initialize message variable

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if($user){
        $message = "User already created. Please choose a different username.";
    }else{
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to dashboard after successful registration
        exit();
    }
}
  


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register - ChatApp</title>
  <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <img src="/assets/images/chat-logo.png" alt="ChatApp Logo">
        <h1>ChatApp</h1>
      </div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Features</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main class="auth-page">
    <div class="form-container">
      <h2>Register</h2>
      <form action="/register.php" method="post">
        <div class="form-group">
          <label for="username">username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <?php if (!empty($message)): ?>
        <div class="message">
          <?php echo htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>
        <button type="submit" class="btn register-btn">Register</button>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>
      </form>
    </div>
  </main>

  <footer class="footer">
    <div class="footer-content">
      <div class="footer-logo">
        <img src="/assets/images/chat-logo-footer.png" alt="ChatApp Footer Logo">
        <h2>ChatApp</h2>
      </div>
      <div class="footer-links">
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
      </div>
      <div class="social-icons">
        <a href="#"><img src="/assets/icons/facebook.png" alt="Facebook"></a>
        <a href="#"><img src="/assets/icons/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="/assets/icons/instagram.png" alt="Instagram"></a>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 ChatApp. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
