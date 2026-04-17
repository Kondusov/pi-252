<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StepUp - Магазин обуви</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 1rem; }
        .nav { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; }
        .nav a { color: white; text-decoration: none; margin-left: 20px; }
        .nav a:hover { color: #3498db; }
        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: white; border-radius: 8px; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 5px; }
        .product-card h3 { margin: 10px 0; color: #2c3e50; }
        .price { font-size: 1.2em; color: #e74c3c; font-weight: bold; margin: 10px 0; }
        .btn { background: #3498db; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #2980b9; }
        .btn-success { background: #27ae60; }
        .btn-danger { background: #e74c3c; }
        .cart-item { background: white; padding: 15px; margin-bottom: 10px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .message { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .order-summary { background: white; padding: 20px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <h1><a href="index.php" style="color: white; text-decoration: none;">👟 StepUp</a></h1>
            <div>
                <?php if(isLoggedIn()): ?>
                    <a href="cart.php">🛒 Корзина</a>
                    <?php if(isAdmin()): ?>
                        <a href="admin.php">⚙️ Админ-панель</a>
                    <?php endif; ?>
                    <span style="margin-left: 20px;"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="logout.php">Выйти</a>
                <?php else: ?>
                    <a href="login.php">Войти</a>
                    <a href="register.php">Регистрация</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <div class="container">