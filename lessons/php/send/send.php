<?php
// 1. Подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'reg18');

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
// 2. Получение данных из формы
$userName = $_POST['user_name'];
$userAge = $_POST['user_age'];
$userPass = $_POST['user_pass'];
echo gettype($userName);
echo gettype($userAge);
echo gettype($userPass);

if($userAge<18){
    echo($userName." вам еще нет 18<br>");
}else{
        // 3. Безопасная запись (подготовленные выражения) [10]
    $stmt = $conn->prepare("INSERT INTO users (name, age, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userName, $userAge, $userPass);

    if ($stmt->execute()) {
        echo "Данные успешно добавлены!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    echo 'Поздравляем с регистрацией '.$userName;
}
$stmt->close();
$conn->close();
?>
<br>
<a href="/">Вернуться на главную</a>

<!-- http://send/send.php?user_name=Bdfy&user_age=342 -->