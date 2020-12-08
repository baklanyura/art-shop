<?php
    // Выполняем подключение к базе данных
    include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
    
// Если существуют пречисленные переменные и они не равны пустоте => выполнить sql запрос    
if(
    isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["id"])
    && $_POST["title"] != "" && $_POST["description"] != "" 
) {
    // прописываем строку для изменения данных товара (в БД) введенных в форму
    $sql = "UPDATE categories SET `title` = '" . $_POST["title"] . "', `description` = '" . $_POST["description"] . "',  
    `image` = '" . $_POST["image"] . "' WHERE id=" . $_POST["id"];
    // если выполняется sql запрос, изменяем категорию и выводим сообщение "Категория обновлена"
    if(mysqli_query($conn, $sql)) {
        header("Location: /admin/categories.php");
        // Выводим на экран "Товар добавлен"
        echo "<h2>Категория обновлена</h2>";        
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
        <a style="color: grey; cursor: default" href="">Edit Category</a>
    </li>
  </ol>
</nav>                  
<div class="row">
    <div class="col-md-8">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Edit Category</h4>
            </div>
            <div class="card-body">
                <!-- Делаем форму для характеристик и описания категории -->
                <form action="edit_category.php" method="POST">
                <?php
                        // Выполняем запрос выбрать все из таблицы categories где значение поля category_id = переменной $_GET["id"]
                        $sql_category = "SELECT * FROM categories WHERE id=" . $_GET["id"];
                        $result_category = $conn->query($sql_category);
                        $category = mysqli_fetch_assoc($result_category);
                    ?>
                    <input type="hidden" value="<?php echo $category["id"] ?>" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <!-- Поле для ввода заголовка -->
                                <input type="text" class="form-control" placeholder="Enter Title" value="<?php echo $category["title"] ?>" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <!-- Поле для ввода краткого описания -->
                                <input type="text" class="form-control" placeholder="Enter Description" value="<?php echo $category["description"] ?>" name="description">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Кнопка для отправки данных в базу -->
                    <button style="cursor: pointer;" type="submit" class="btn btn-info btn-fill pull-right">Save Edit</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>                       
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php";
?>

   