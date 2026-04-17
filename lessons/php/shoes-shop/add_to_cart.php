<?php
require_once 'config.php';

if(!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $user_id = $_SESSION['user_id'];
    
    // Проверяем, есть ли уже такой товар в корзине
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND size = ?");
    $stmt->execute([$user_id, $product_id, $size]);
    $existing = $stmt->fetch();
    
    if($existing) {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $stmt->execute([$existing['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, size) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $size]);
    }
    
    header('Location: cart.php');
    exit;
}