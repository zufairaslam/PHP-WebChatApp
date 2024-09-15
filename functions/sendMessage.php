<?php
include '../includes/db.php';
include '../includes/session.php';

if(isset($_POST['message']) && isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $message = $_POST['message'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if($user){
        $stmt2 = $pdo->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
        $stmt2->execute(['username' => $username, 'message' => $message]);
        echo json_encode(['success' => true, 'message' => htmlspecialchars($message), 'username' => htmlspecialchars($username)]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Message or username missing']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Message or username missing']);
}


?>