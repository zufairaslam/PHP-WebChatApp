<?php
include 'includes/db.php';
include 'includes/session.php';
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch();
  if(!$user){
    header("Location: login.php"); // Redirect to dashboard after successful registration
    exit();
  }

}else{
  header("Location: login.php"); // Redirect to dashboard after successful registration
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard - ChatApp</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
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
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="chat-container">
    <div class="chatbox">
      <div class="chat-header">
        <h2>Public Chat</h2>
      </div>
      <div class="chat-messages" id="chat-messages">
    <?php
    $stmt3 = $pdo->query("SELECT * FROM messages ORDER BY created_at ASC");
    $messages = $stmt3->fetchAll();
    
    foreach ($messages as $message) {
        $username = htmlspecialchars($message['username'], ENT_QUOTES, 'UTF-8');
        $messageContent = htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8');
        echo '<div class="chat-message"><strong>' . $username . ':</strong> ' . $messageContent . '</div>';
    }        
    ?>
</div>
      <div class="chat-input">
        <form id="chat-form" action="/functions/sendMessage.php" method="post">
          <input type="text" id="message" name="message" placeholder="Type your message..." required autocomplete="off">
          <button type="submit" class="btn">Send</button>
        </form>
      </div>
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

<script>
document.getElementById('chat-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const message = document.getElementById('message').value;

  fetch('/functions/sendMessage.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `message=${encodeURIComponent(message)}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      document.getElementById('message').value = '';

      const chatMessages = document.getElementById('chat-messages');
      const newMessage = document.createElement('div');
      newMessage.classList.add('chat-message'); 
      newMessage.innerHTML = `<strong>${data.username}:</strong> ${data.message}`;

      chatMessages.appendChild(newMessage);
      
      chatMessages.scrollTop = chatMessages.scrollHeight;
    } else {
      console.error('Message sending failed', data.error);
    }
  })
  .catch(error => console.error('Error:', error));
});


function fetchMessages() {
    fetch('/functions/recieveMessage.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const chatMessages = document.getElementById('chat-messages');

                chatMessages.innerHTML = '';

                data.message.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('chat-message');
                    messageDiv.innerHTML = `<strong>${msg.username}:</strong> ${msg.message}`;
                    chatMessages.appendChild(messageDiv);
                });

                chatMessages.scrollTop = chatMessages.scrollHeight;
            } else {
                console.error('Failed to fetch messages');
            }
        })
        .catch(error => console.error('Error:', error));
}

setInterval(fetchMessages, 5000);

fetchMessages();
  </script>
</html>
