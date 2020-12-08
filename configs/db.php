<?php
// Данные для подключения к базе данных
$server = "localhost"; // адрес сервера
$username = "root"; // имя пользователя
$password = ""; // пароль
$dbname = "art-shop"; // имя базы данных

// Подключение к базе данных chat
$conn = new mysqli($server, $username, $password, $dbname);
// Кодировка базы данных
$conn->set_charset('utf8');

/* $sql = "SELECT * FROM users"; // прописал строку (текст) для получения списка всех пользователей

// mysqli_query - выполнить sql запрос
// 2 параметра: 1. Подключение к б.д. 2. sql скрипт
$result = mysqli_query($connect, $sql);

// mysqli_num_rows - получить кол-во результатов
$col_users = mysqli_num_rows($result);

echo "<pre>";
var_dump($col_users);
echo "</pre>";

$i = 0;

while ($i < $col_users) {
    / mysqli_fetch_assoc - преобразовать полученные данные пользователя в массив
    $user = mysqli_fetch_assoc($result);
    echo "<pre>";
    var_dump($user);
    $i = $i + 1;
} */

?>