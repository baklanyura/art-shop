<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    
// Если существуют пречисленные переменные и они не равны пустоте => выполнить sql запрос    
if(
    isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["content"]) && isset($_POST["category"]) && isset($_POST["id"])
    && $_POST["title"] != "" && $_POST["description"] != "" && $_POST["content"] != "" && $_POST["category"] != ""
) {
    // прописываем строку для изменения данных товара (в БД) введенных в форму
    $sql = "UPDATE products SET `title` = '" . $_POST["title"] . "', `description` = '" . $_POST["description"] . "', `content` = '" . $_POST["content"] 
    . "', `category_id` = '" . $_POST["category"] . "', `image` = '" . $_POST["image"] . "' WHERE id=" . $_POST["id"];
    // если выполняется sql запрос, изменяем товар и выводим сообщение "Товар обновлен"
    if(mysqli_query($conn, $sql)) {
        header("Location: /admin/products.php");
        // Выводим на экран "Товар добавлен"
        echo "<h2>Товар обновлен</h2>";
        
    }
    
}
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/header.php";
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item">
        <a href="/admin">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/admin/products.php">Products</a>
    </li>
    <li class="breadcrumb-item">
        <a style="color: grey; cursor: default" href="">Edit Products</a>
    </li>
  </ol>
</nav>                       
<div class="row">
    <div class="col-md-8">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Edit Products</h4>
            </div>
            <div class="card-body">
                <!-- Делаем форму для характеристик и описания товара -->
                <form action="edit.php" method="POST">
                <?php
                        // Выполняем запрос выбрать все из таблицы products где значение поля category_id = переменной $_GET["id"]
                        $sql_product = "SELECT * FROM products WHERE id=" . $_GET["id"];
                        $result_product = $conn->query($sql_product);
                        $product = mysqli_fetch_assoc($result_product);
                    ?>
                    <input type="hidden" value="<?php echo $product["id"] ?>" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <!-- Поле для ввода заголовка -->
                                <input type="text" class="form-control" placeholder="Enter Title" value="<?php echo $product["title"] ?>" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <!-- Поле для ввода краткого описания -->
                                <input type="text" class="form-control" placeholder="Enter Description" value="<?php echo $product["description"] ?>" name="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea style="height: 100px" rows="10" cols="80" class="form-control" placeholder="Here can be your Content" name="content"><?php echo $product["content"] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <!-- Поля для выбора категории -->
                                <select style="cursor: pointer;" class="form-control" name="category">
                                    <option value="0">Select category</option>
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $result = $conn->query($sql);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if($product["category_id"] == $row["id"]) {
                                            echo "<option value='" . $row["id"] . "' selected>" . $row["title"] . "</option>";
                                        } else {
                                            echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";

                                        }
                                        
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Select image</label>
                            <input style="cursor: pointer;" type="file" class="custom-file-input" value="<?php echo $product["image"] ?>" placeholder="Choose file" id="inputGroupFile02" name="image">
                            <!-- <form enctype="multipart/form-data" >
                                <label>Image</label>
                                <input type="file" name="image">
                            </form> -->
                        </div>    
                    </div>
                    <!-- Кнопка для отправки данных в базу -->
                    <button style="cursor: pointer;" type="submit" class="btn btn-success btn-fill pull-right">Save Edit</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>                       
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php";
?>

   