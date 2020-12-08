<?php
    // Подключаем Базу данных
    include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    $page = "products";
    include "parts/header.php";

    $sql = "SELECT * FROM products ";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $categoryResult = $conn->query( "SELECT * FROM categories WHERE id=" . $row["category_id"] );
    $category = mysqli_fetch_assoc( $categoryResult );
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item">
        <a href="/admin">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a style="color: grey; cursor: default" href="">Products</a>
    </li>
  </ol>
</nav>
<div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">
                        Products
                        <!-- Кнопка для добавления продукта -->
                        <a href="options/products/add_product.php" type="button" class="btn btn-secondary">Add Product</a>
                    </h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                        <?php
                            // Выполняем запрос выбрать все из таблицы products
                            $sql = "SELECT * FROM products";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <!-- Выводим данные из базы -->
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["title"] ?></td>
                                <td><?php echo $row["description"] ?></td>
                                <td><?php echo $row["content"] ?></td>
                                <td><?php echo $row["category_id"] ?></td>
                                <td>
                                    <!-- Делаем кнопки для удаления Delete и редактирования Edit товара -->
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="options/products/edit.php?id=<?php echo $row["id"] ?>" type="button" class="btn btn-secondary">Edit</a>
                                        <a href="options/products/delete.php?id=<?php echo $row["id"] ?>" type="button" class="btn btn-secondary">Delete</a>                                                    
                                    </div>
                                </td>
                            </tr>
                        <?php                                               
                            }
                        ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                       
    </div>
</div>
<?php
include "parts/footer.php";
?>