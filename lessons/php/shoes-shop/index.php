<?php
require_once 'config.php';
include 'header.php';

// Получение товаров
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Каталог обуви</h2>
<div class="product-grid">
    <?php foreach($products as $product): ?>
    <div class="product-card">
        <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p><?= htmlspecialchars($product['brand']) ?></p>
        <p>Размеры: <?= htmlspecialchars($product['size']) ?></p>
        <div class="price"><?= number_format($product['price'], 0, ',', ' ') ?> ₽</div>
        
        <?php if(isLoggedIn()): ?>
        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <select name="size" required>
                <option value="">Выберите размер</option>
                <?php foreach(explode(',', $product['size']) as $size): ?>
                <option value="<?= trim($size) ?>"><?= trim($size) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn">В корзину</button>
        </form>
        <?php else: ?>
        <a href="login.php" class="btn">Войти для заказа</a>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>