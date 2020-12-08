<?php
    // Подключаем Базу данных
    include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    $page = "orders";
    include "parts/header.php";

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/admin">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a style="color: grey; cursor: default" href="">Orders</a>
    </li>
  </ol>
</nav>  
<!-- Отображаем таблицу продуктов добавленых в корзину -->
<div class="row" id="products">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Заказ</th>
                <th scope="col">Заказ</th>

                <th scope="col">Сумма</th>
                <th scope="col">Status</th>
                <th scope="col">Username</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Options</th>

            </tr>
        </thead>
        <tbody>

        <?php
                $sql = "SELECT * FROM `orders`";
                $result_order = $conn->query($sql);

                // Переменная i = 0; пока переменная i меньше кол-ва товаров в корзине; увеличиваем значение $i++
                while ($order = mysqli_fetch_assoc($result_order)) {
                    // Выбираем все поля из таблицы products где id = значению $basket["basket"]["$i"]
                    $sql = "SELECT * FROM users WHERE id=" . $order["user_id"];
                    // Выполняем sql запрос
                    $result = $conn->query($sql);
                    // Преобразовываем полученные данные в массив
                    $user = mysqli_fetch_assoc($result);

                    $productOrder = json_decode($order['products'], true);
                     
                    ?>
                        <tr>
                            <th scope="row"><?php echo $order["id"]; ?></th>

                            <td>
                            <?php 
                                $total = 0;
                                for($i = 0; $i < count($productOrder['basket']); $i++) {
                                    $sql_product = "SELECT * FROM products WHERE id=" . $productOrder["basket"]["$i"]["product_id"];
                                    $result_product = $conn->query($sql_product);
                                    $product = mysqli_fetch_assoc($result_product);  
                                    echo $product['title'] . " - " . $productOrder["basket"]["$i"]["count"] . ' шт <br>';
                                    $total = $total + $product["cost"];
                                     
                                }
                            ?>
                            </td>
                            <td>
                            <?php 
                               
                                for($i = 0; $i < count($productOrder['basket']); $i++) {
                                    $sql_product = "SELECT * FROM products WHERE id=" . $productOrder["basket"]["$i"]["product_id"];
                                    $result_product = $conn->query($sql_product);
                                    $product = mysqli_fetch_assoc($result_product);  
                                    echo $product["cost"] . ' грн <br>';
                                    
                                     
                                }
                            ?>
                            </td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order["status"]; ?></td>
                            <td><?php echo $user["login"]; ?></td>
                            <td><?php echo $order["address"]; ?></td>
                            <td><?php echo $user["phone"]; ?></td>
                            <td>
                                <a href="options/orders/del-order.php?id=<?php echo $order["id"] ?>" type="button" class="btn btn-primary">Delete</a>
                                <a href="options/orders/change-status.php?id=<?php echo $order['id'] ?>" 
                                    type="button" class="btn btn-secondary"> Изменение статуса</a>
                            </td>   
                        </tr>
        <?php
                    
                }       
                
            
        ?>  
        </tbody>
    </table>
</div>
<?php
include "parts/footer.php";
?>