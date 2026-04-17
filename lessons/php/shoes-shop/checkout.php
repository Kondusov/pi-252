<?php
require_once 'config.php';

if(!isLoggedIn() || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: cart.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];

// Получаем данные корзины
$stmt = $pdo->prepare("
    SELECT c.*, p.name, p.price, p.brand 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(empty($cart_items)) {
    header('Location: cart.php');
    exit;
}

// Рассчитываем итоговую сумму
$total = 0;
$order_details = "";
$order_number = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

foreach($cart_items as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    $order_details .= "{$item['name']} ({$item['brand']}), размер {$item['size']}, {$item['quantity']} шт. - " . number_format($subtotal, 0, ',', ' ') . " ₽\n";
}

// Подготовка email сообщения
$to = $user_email;
$subject = "Заказ #{$order_number} - StepUp";
$message = "
Здравствуйте, {$user_name}!

🎉 Спасибо за заказ в магазине StepUp!

Номер заказа: {$order_number}
Дата: " . date('d.m.Y H:i') . "

Состав заказа:
{$order_details}

Итого к оплате: " . number_format($total, 0, ',', ' ') . " ₽

Статус заказа: Принят в обработку

Мы свяжемся с вами в ближайшее время для подтверждения заказа.

С уважением,
команда StepUp
";

$headers = "From: shop@stepup.ru\r\n";
$headers .= "Reply-To: shop@stepup.ru\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Отправка email
$email_sent = mail($to, $subject, $message, $headers);

// Очистка корзины
$stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);

include 'header.php';
?>

<div class="order-summary">
    <h2 style="color: #27ae60;">✅ Заказ успешно оформлен!</h2>
    <div class="message success">
        <h3>🎉 Поздравляем, <?= htmlspecialchars($user_name) ?>!</h3>
        <p>Ваш заказ #<?= $order_number ?> принят в обработку.</p>
        <p>Подтверждение отправлено на email: <?= htmlspecialchars($user_email) ?></p>
        <?php if(!$email_sent): ?>
            <p style="color: #856404;">(Email не отправлен - настройте SMTP на сервере)</p>
        <?php endif; ?>
    </div>
    
    <h3>Состав заказа:</h3>
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 10px; text-align: left;">Товар</th>
                <th style="padding: 10px;">Размер</th>
                <th style="padding: 10px;">Кол-во</th>
                <th style="padding: 10px; text-align: right;">Сумма</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cart_items as $item): ?>
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 10px;">
                    <?= htmlspecialchars($item['name']) ?> (<?= htmlspecialchars($item['brand']) ?>)
                </td>
                <td style="padding: 10px; text-align: center;"><?= $item['size'] ?></td>
                <td style="padding: 10px; text-align: center;"><?= $item['quantity'] ?></td>
                <td style="padding: 10px; text-align: right;">
                    <?= number_format($item['price'] * $item['quantity'], 0, ',', ' ') ?> ₽
                </td>
            </tr>
            <?php endforeach; ?>
            <tr style="font-weight: bold; background: #f8f9fa;">
                <td colspan="3" style="padding: 15px; text-align: right;">Итого:</td>
                <td style="padding: 15px; text-align: right;"><?= number_format($total, 0, ',', ' ') ?> ₽</td>
            </tr>
        </tbody>
    </table>
    
    <p>Это же сообщение отправлено на вашу почту <?= htmlspecialchars($user_email) ?></p>
    
    <div style="margin-top: 30px;">
        <a href="index.php" class="btn">🛍️ Продолжить покупки</a>
    </div>
</div>

<?php include 'footer.php'; ?>