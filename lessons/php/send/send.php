<?php
// $userName = $_GET['user_name'];
// $userAge = $_GET['user_age'];
$userName = $_POST['user_name'];
$userAge = $_POST['user_age'];

if($userAge<18){
    echo($userName." вам еще нет 18<br>");
}else{
    echo 'Поздравляем с регистрацией '.$userName;
}
?>
<br>
<a href="/">Вернуться на главную</a>

<!-- http://send/send.php?user_name=Bdfy&user_age=342 -->