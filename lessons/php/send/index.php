<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="send.php" method='POST'>
        <input type="text" name='user_name' placeholder='Введите имя'>
        <input type="number" name='user_age' placeholder='Введите возраст' min='0' max='101'>
        <input type="password" name='user_pass'>
        <input type="submit">
    </form>
<?php
// 1. Подключение к базе данных
$host = 'localhost';
$user = 'root'; // ваш логин
$pass = '';     // ваш пароль
$name = 'reg18'; // имя базы данных

$link = mysqli_connect($host, $user, $pass, $name);

if (!$link) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

// 2. SQL-запрос
$sql = "SELECT id, name, age FROM users";
$result = mysqli_query($link, $sql);
var_dump($result);
// 3. Вывод данных на страницу
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>" . $row['id'] .' '. $row['name'].' '. $row['age']. "</p>";
    }
} else {
    echo "Ошибка: " . mysqli_error($link);
}

// 4. Закрытие соединения
mysqli_close($link);
?>
<a href="private.txt">На приват файл</a>
</body>
</html>