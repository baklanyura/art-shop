<!-- изменение статуса товара -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

$sql = "SELECT * FROM orders";
$rezult = $conn->query($sql);
$row = mysqli_fetch_assoc($rezult);

$sql = "UPDATE `orders` SET `status` = 'Отправлен клиенту' WHERE `orders`.`id` = '
" .  $_GET['id'] . "' ";

 if (mysqli_query($conn, $sql)) {
    
    header("Location: /admin/orders.php");   
} else { echo "<h2>Ошибка</h2>"; }

?>