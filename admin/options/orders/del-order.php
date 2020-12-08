<?php
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

// Выполняем удаление товара
//Если существует переменная $_GET["id"]
if(isset($_GET["id"])) {
    $sql = "DELETE FROM `orders` WHERE `id` =" . $_GET["id"];
    if(mysqli_query($conn, $sql)) {
        header("Location: /admin/orders.php");
    } 
}


?>