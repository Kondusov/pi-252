<?php
require_once 'config.php';

if(!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

include 'header.php';

// Получаем содержимое корзины
$stmt = $pdo->prepare("
    SELECT c.*, p.name, p.price, p.brand 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>

<h2>🛒 Ваша корзина</h2>

<?php if(empty($cart_items)): ?>
    <p>Корзина пуста. <a href="index.php">Перейти к покупкам</a></p>
<?php else: ?>
    <?php foreach($cart_items as $item): 
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
    <div class="cart-item">
        <div>
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p><?= htmlspecialchars($item['brand']) ?> | Размер: <?= $item['size'] ?></p>
            <p>Цена: <?= number_format($item['price'], 0, ',', ' ') ?> ₽</p>
        </div>
        <div>
            <span>Количество: <?= $item['quantity'] ?></span>
            <p><strong><?= number_format($subtotal, 0, ',', ' ') ?> ₽</strong></p>
            <a href="remove_from_cart.php?id=<?= $item['id'] ?>" class="btn btn-danger" style="padding: 5px 10px;">Удалить</a>
        </div>
    </div>
    <?php endforeach; ?>
    
    <div style="text-align: right; margin-top: 20px; font-size: 1.2em;">
        <strong>Итого: <?= number_format($total, 0, ',', ' ') ?> ₽</strong>
    </div>
    
    <form method="POST" action="checkout.php" style="margin-top: 20px;">
        <button type="submit" name="checkout" class="btn btn-success">📦 Оформить заказ</button>
    </form>
<?php endif; ?>

<?php include 'footer.php'; ?>