<?php
// Подключаем Базу данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

// Если существует переменная POST и использован метод отправки данных POST
if(isset($_POST) and $_SERVER["REQUEST_METHOD"] == "POST") {
    // Шифруем пароль
    $password = md5($_POST['pass']);

    // Авторизация
    $login = "SELECT * FROM admins WHERE username LIKE '" . $_POST['username'] . "' AND password LIKE '" . $password . "'";
        
    $resultLogin = $conn->query($login);

    if($resultLogin->num_rows > 0) {
        // преобразовываем полученные данные пользователя в массив
        $user = mysqli_fetch_assoc($resultLogin);
        // Создаем куки для хранения данных пользователя time() + 1000 - время существования куки (нахождение польз-ля в системе)
        setcookie("admin_id", $user["id"], time() + 60*60);
        header("Location: http://art-shop/admin");
    } else {
        // иначе выводим на экран "Логин или пароль введены не верно!"
        echo "<h2>Логин или пароль введены не верно!</h2>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
</head>
<body style="background-image: url(/admin/assets/img/full-screen-image-3.jpg); background-size: cover; ">
    <!-- Создаем форму для авторизации -->
    <div id="main-block">
        <h2 class="author-header">Authorization</h2>            
            <form action="login.php" method="POST" class="content">

                <!-- Поле для ввода имени -->
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Login" name="username" required/>
                <!-- Поле для ввода пароля -->
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" required/>
                <!-- Кнопка для отправки введенных данных -->
                <button type="submit" class="inputbtn">Log In</button>
                <!-- Ссылка для перехода на страницу регистрации -->
                <a class="registration" href="register.php">Registration</a>
                
            </form>
    </div>
</body>
</html>
