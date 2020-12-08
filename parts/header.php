<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/css/bootstrap-reboot.css">

     <title>Shop</title>
 </head>
 <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contacts.php">Contacts</a>
            </li>
            
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <a class="btn btn-success ml-4" href="/basket.php" id="go-basket">
                    Корзина - <span></span>
                </a>
                <?php
                    // Если существует переменная $_COOKIE["user_id"] (Пользователь в системе)
                    if(isset($_COOKIE["user_id"])) {
                        $sql = "SELECT * FROM users WHERE id =" . $_COOKIE["user_id"];
                        // выполнить sql запрос в базе данных
                        $result = $conn->query($sql);
                        $user = mysqli_fetch_assoc($result);
                    ?>
                        <!--Создаем ссылку на выход из профиля -->
                        <a href="exit.php" type="button" class="btn btn-light ml-2"><?php echo $user["login"]; ?> &#187;</a>
                    <?php
                    } else {
                    ?>
                        <!--Иначе создаем ссылку в Меню на окно Авторизации -->
                        <a href="/login.php" type="button" class="btn btn-primary ml-2">Log in</a>
                    <?php

                    }
                    ?>
                <a href="/register.php" type="button" class="btn btn-secondary ml-2">Register</a>
                
            </form>
            <!-- <div class="col-md-1 hidden-xs hidden-sm text-center margin-top-10">
                <a class="no-text-decoration grey-link" href="#">
                    <div class="cart-item">
                        <img src="images/basket2.png" width="32" alt="">
                        <br>
                        <span>Корзина</span>
                    </div>
                </a>
            </div> -->
            <!-- <a href="#" style="text-decoration: none; text-align: center;">
                <img src="images/basket2.png" alt="" width="40">
                <br>
                <span>Корзина</span>
            </a> -->
        </div>
    </nav>

    
    <div class="container">
        <div class="row m-2">
            <div class="col-3">
            <?php 
                include $_SERVER['DOCUMENT_ROOT'] . "/parts/cat_nav.php";
            ?>
            </div>
            <div class="col-9">
                <div class="container">