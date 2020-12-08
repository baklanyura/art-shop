<?php
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
// Задаем переменной $page значение которое будет в GET запросе get_more.php?page="
$page = $_GET["page"];
// Умножаем значение переменной $page на 6
$offset = $page * 6;
// Выбираем из таблицы products только 6 позиций, через(OFFSET - отступ)
// + значение переменной $offset, получается через 6 позиций отображаем следующие 6
$sql = "SELECT * FROM products LIMIT 6 OFFSET " . $offset;
$result = $conn->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    include $_SERVER['DOCUMENT_ROOT'] . "/parts/product_card.php";
}

?>