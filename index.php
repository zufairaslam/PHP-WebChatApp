<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChatApp</title>
  <link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <img src="/assets/images/chat-logo.png" alt="ChatApp Logo">
        <h1>ChatApp</h1>
      </div>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Features</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Connect with Anyone, Anytime</h1>
      <p class="tagline">Join ChatApp today and start conversations with friends, family, and colleagues in real-time!</p>
      <div class="auth-buttons">
      <button class="btn login" onclick="redirectToLogin()">Login</button>
        <button class="btn signup" onclick="redirectToRegister()">Sign Up</button>
      </div>
    </div>
    <div class="hero-image">
      <img src="/assets/images/chat-illustration.png" alt="Chat Illustration">
    </div>
  </section>

  <section class="features">
    <h2>Why Choose ChatApp?</h2>
    <div class="features-grid">
      <div class="feature-item">
        <img src="/assets/images/feature1.png" alt="Feature 1">
        <h3>Instant Messaging</h3>
        <p>Real-time messaging to stay connected with your friends and family instantly.</p>
      </div>
      <div class="feature-item">
        <img src="/assets/images/feature2.png" alt="Feature 2">
        <h3>Secure Chats</h3>
        <p>End-to-end encryption to keep your conversations private and secure.</p>
      </div>
      <div class="feature-item">
        <img src="/assets/images/feature3.png" alt="Feature 3">
        <h3>Multi-Platform</h3>
        <p>Use ChatApp on any device, anywhere, anytime—stay connected wherever you are.</p>
      </div>
    </div>
  </section>

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
<script>
    function redirectToLogin() {
      window.location.href = 'login.php';
    }

    function redirectToRegister() {
      window.location.href = 'register.php';
    }
  </script>
</html>
