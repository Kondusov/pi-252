<?php
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    //var_dump($user['password']);
    //die();
    // Для теста: пароль admin123 для админа
    if($user && $password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        
        header('Location: index.php');
        exit;
    } else {
        $error = "Неверный email или пароль";
    }
}

include 'header.php';
?>

<h2>Вход в аккаунт</h2>
<?php if(isset($error)): ?>
    <div class="message error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>Пароль</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit" class="btn">Войти</button>
    <a href="register.php">Нет аккаунта? Зарегистрироваться</a>
</form>

<?php include 'footer.php'; ?>