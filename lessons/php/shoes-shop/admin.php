<?php
require_once 'config.php';

if(!isLoggedIn() || !isAdmin()) {
    header('Location: index.php');
    exit;
}

// Добавление товара
if(isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $size = $_POST['size'];
    $image = $_POST['image'] ?: 'placeholder.jpg';
    
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, brand, size, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $brand, $size, $image]);
    
    header('Location: admin.php');
    exit;
}

// Удаление товара
if(isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: admin.php');
    exit;
}

include 'header.php';

$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
?>

<h2>⚙️ Административная панель</h2>

<h3>Добавить новый товар</h3>
<form method="POST" style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div class="form-group">
            <label>Название</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Бренд</label>
            <input type="text" name="brand" required>
        </div>
        <div class="form-group">
            <label>Цена</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Размеры (через запятую)</label>
            <input type="text" name="size" placeholder="41,42,43" required>
        </div>
        <div class="form-group">
            <label>Изображение (имя файла)</label>
            <input type="text" name="image" placeholder="nike.jpg">
        </div>
        <div class="form-group">
            <label>Описание</label>
            <textarea name="description" rows="2"></textarea>
        </div>
    </div>
    <button type="submit" name="add_product" class="btn btn-success">Добавить товар</button>
</form>

<h3>Управление товарами</h3>
<table style="width: 100%; background: white; border-collapse: collapse;">
    <thead>
        <tr style="background: #2c3e50; color: white;">
            <th style="padding: 10px;">ID</th>
            <th style="padding: 10px;">Название</th>
            <th style="padding: 10px;">Бренд</th>
            <th style="padding: 10px;">Цена</th>
            <th style="padding: 10px;">Размеры</th>
            <th style="padding: 10px;">Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $product): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $product['id'] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($product['name']) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($product['brand']) ?></td>
            <td style="padding: 10px;"><?= number_format($product['price'], 0, ',', ' ') ?> ₽</td>
            <td style="padding: 10px;"><?= htmlspecialchars($product['size']) ?></td>
            <td style="padding: 10px;">
                <a href="?delete=<?= $product['id'] ?>" class="btn btn-danger" style="padding: 5px 10px;" 
                   onclick="return confirm('Удалить товар?')">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>