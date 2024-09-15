<?php
include '../includes/db.php';
include '../includes/session.php';

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if($user){
        $stmt3 = $pdo->query("SELECT * FROM messages ORDER BY created_at ASC");
        $messages = $stmt3->fetchAll();
        echo json_encode(['success' => true, 'message' => $messages, 'username' => htmlspecialchars($username)]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Message or username missing']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Message or username missing']);
}


?>