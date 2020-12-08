<?php
// Подключаем Базу данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

// Если существует переменная POST и использован метод отправки данных POST
if(isset($_POST) and $_SERVER["REQUEST_METHOD"] == "POST") {
    $err = [];

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['pass']) < 5 or strlen($_POST['pass']) > 30)
    {
        $err[] = "Пароль должен быть не меньше 5-ти символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $checkLogin = "SELECT * FROM admins WHERE login='" . $_POST['username'] . "'";

    $resultCheck = $conn->query($checkLogin);

    if($resultCheck->num_rows > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        // Шифруем пароль
        $password = md5($_POST['pass']);

        // Регистрация
        $register = "INSERT INTO admins (username, password) VALUES ('" . $_POST['username'] . "', '" 
        . $password . "')";

        
        if($conn->query($register)) {
            echo "Пользователь зарегистрирован";
            header("Location: http://art-shop/admin/");
        }
    } else {
        echo "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            echo $error."<br>";
        }
    }
    
}

/*
1. Сделать форму регистрации
2. Сделать отправку формы
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
</head>
<body style="background-image: url(/admin/assets/img/full-screen-image-3.jpg); background-size: cover; ">
    <!-- Создаем форму для Регистрации -->
    <div id="main-block">
        <h2 class="reg-header">Registration</h2>            
            <form action="register.php" method="POST" class="content">
                <!-- Поле для ввода эмейла -->
                <label for="email"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="username" required/>
                <!-- Поле для ввода пароля -->
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" required/>
                <!-- Кнопка для отправки введенных данных -->
                <button type="submit" class="inputbtn">Register</button>
                <!-- Ссылка для перехода на страницу Авторизации -->
                <a class="authorization" href="login.php">Authorization</a>
            </form>
        
    </div>
</body>
</html>
