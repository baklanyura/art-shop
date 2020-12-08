<?php
// Выполняем подключение к базе данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/configs/configs.php";
include $_SERVER['DOCUMENT_ROOT'] . "/modules/telegram/send-message.php";

 /*
1. Проверить есть ли в базе данных пользователь с номером телефона что ввел пользователь
2. Если нет то регистрируем пользователя 
3. Добавляем заказ в базу данных с привязкой к пользователю
*/

    
if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
    
    $sql_user = "SELECT * FROM users WHERE phone LIKE '" . $_POST["phone"] . "' AND login LIKE '" . $_POST["name"] . "'";
    $user_id = 0;
    $result_user = $conn->query($sql_user);

    if($result_user->num_rows > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $user_id = $user["id"];
    } else {
        $sql = "INSERT INTO users (login, phone) VALUES ('" . $_POST["name"] . "
            ', '" . $_POST["phone"] . "')";
        if($conn->query($sql)) {
            echo "User added!";
            // Переменная $user_id = id пользователя
            $user_id = $conn->insert_id;
        } else {
            /* echo "Error: " . $sql . "<br>" . $conn->error; */
        }
    }
        
        // прописываем строку для отправки данных товара (в БД) введенных в форму
        $sql_order = "INSERT INTO orders (user_id, products, address) VALUES ('" . 
        $user_id . "', '" . $_COOKIE["basket"] . "', '" . $_POST["address"] . "');";
        // если выполняется sql запрос, добавляем товар и выводим сообщение "Заказ оформлен"
        /* echo "<pre>";
        var_dump($_COOKIE["basket"]);
        die(); */
        if($conn->query($sql_order)) {
            /* header("Location: /"); */
            // Очищаем куки
            setcookie("basket", "", 0, "/");
            // Выводим на экран "Заказ оформлен"
            echo "<h2>Заказ оформлен</h2> <br/>
            <a href='/'> На главную </a>";

            message_to_telegram('Ваш заказ оформлен!');
            
        } else {
            /* echo "Error: " . $sql_order . "<br>" . $conn->error; */
        }
    
}
?>