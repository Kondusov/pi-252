<?php
require_once 'config.php';
if(isLoggedIn() && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
}
header('Location: cart.php');