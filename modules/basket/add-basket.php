<?php
include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
/*
    1. Получить товар по которому кликнул пользователь - done
    2. Добавить в массив товаров - done
    3. Добавить массив в куки - done

    4. Перебрать прошлый массив
        4.1 Преобразовать JSON с куки в массив
        4.2 Добавить новый элемент в массив
        4.3 Преобразовать массив в правильный json
        4.4 Добавить в куки
*/
// Проверяем был ли отправлен ПОСТ запрос
if (isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){

    $sql = "SELECT * FROM products WHERE id=" . $_POST["id"];

    $result = $conn->query($sql);

    $product = mysqli_fetch_assoc($result); 

    // Добавление в корзину
    if(isset($_COOKIE["basket"])) { // Если в корзине уже, что то есть
        $basket = json_decode($_COOKIE["basket"], true);

        /*
            1. Пройтись по всему массиву корзины
            2. Проверить есть ли совпадение по id
            3. Если совпадения есть: увеличить кол-во товара
        */

        $issetProduct = 0;
        for($i = 0; $i < count($basket["basket"]); $i++) {
            if( $basket["basket"][$i]["product_id"] == $product["id"] ) {
                $basket["basket"][$i]["count"]++;
                $issetProduct = 1;
            }
        }

        if($issetProduct != 1) {
            $basket["basket"][] = [
                "product_id" => $product["id"],
                "count" => 1
            ];
        }

        /*
            product_id: 1,
            count: 3
        */

    } else { // Если корзина пустая
        $basket = [ "basket" => [ 
            ["product_id" => $product["id"],
            "count" => 1]
        ] ];
    }
    
    // Преобразование массива в JSON формат
    $jsonProduct = json_encode($basket);

    // Очищаем куки
    setcookie("basket", "", 0, "/");

    // Добавляем куки
    setcookie("basket", $jsonProduct, time() + 60*60, "/");

    echo $jsonProduct;
}
?>