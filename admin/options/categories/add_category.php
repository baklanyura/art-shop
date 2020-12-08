<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    
// Если существуют пречисленные переменные и они не равны пустоте => выполнить sql запрос
if(
    isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["image"])
    && $_POST["title"] != "" && $_POST["description"] != ""
) {
    // прописываем строку для отправки данных товара (в БД) введенных в форму
    $sql = "INSERT INTO categories (title, description, image) VALUES ('" . $_POST["title"] . "', '" . $_POST["description"] . "', '" . $_POST["image"] . "')";
    // если выполняется sql запрос, добавляем товар и выводим сообщение "Товар добавлен"
    if(mysqli_query($conn, $sql)) {
        header("Location: /admin/categories.php");
        // Выводим на экран "Товар добавлен"
        echo "<h2>Категория добавлена</h2>";
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
        <a href="/admin/categories.php">Categories</a>
    </li>  
    <li class="breadcrumb-item">
        <a style="color: grey;" href="">Add Category</a>
    </li>
  </ol>
</nav>                       
<div class="row">
    <div class="col-md-8">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
                <!-- Делаем форму для характеристик и описания товара -->
                <form action="add_category.php" method="POST">
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
                    <button style="cursor: pointer;" type="submit" class="btn btn-success btn-fill pull-right">Save Category</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>                       
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php";
?>        

   