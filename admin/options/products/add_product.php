<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    
// Если существуют пречисленные переменные и они не равны пустоте => выполнить sql запрос
if(
    isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["content"]) && isset($_POST["category"]) && isset($_POST["image"])
    && $_POST["title"] != "" && $_POST["description"] != "" && $_POST["content"] != "" && $_POST["category"] != ""
) {
    // прописываем строку для отправки данных товара (в БД) введенных в форму
    $sql = "INSERT INTO products (title, description, content, category_id, image) VALUES ('" . $_POST["title"] . "', '" . $_POST["description"] . "', '" . $_POST["content"] . "', '" . $_POST["category"] . "', '" . $_POST["image"] . "')";
    // если выполняется sql запрос, добавляем товар и выводим сообщение "Товар добавлен"
    if(mysqli_query($conn, $sql)) {
        header("Location: /admin/products.php");
        // Выводим на экран "Товар добавлен"
        echo "<h2>Товар добавлен</h2>";
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
        <a style="color: grey; cursor: default" href="">Add Products</a>
    </li>
  </ol>
</nav>                       
<div class="row">
    <div class="col-md-8">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Add Products</h4>
            </div>
            <div class="card-body">
                <!-- Делаем форму для характеристик и описания товара -->
                <form action="add_product.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Enter Title" value="" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" placeholder="Enter Description" value="" name="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea style="height: 100px" rows="10" cols="80" class="form-control" placeholder="Here can be your Content" value="" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select style="cursor: pointer;" class="form-control" name="category">
                                    <option value="0" selected>Select category</option>
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $result = $conn->query($sql);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Select image</label>
                            <input style="cursor: pointer;" type="file" class="custom-file-input" placeholder="Choose file" id="inputGroupFile02" name="image" value="/../images/5.jpg">
                            <!-- <form enctype="multipart/form-data" >
                                <label>Image</label>
                                <input type="file" name="image">
                            </form> -->
                        </div>    
                    </div>
                    <button name="submit" value="1" style="cursor: pointer;" type="submit" class="btn btn-success btn-fill pull-right">Save Product</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>                       
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php";
?>        

   