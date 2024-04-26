<?php

require_once ("connect_db.php");

if (!empty ($_POST['login']) and !empty ($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE phone = '$login'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_array($result);
    $get_password = $user['password'];
    $p = password_hash($password, PASSWORD_DEFAULT);
    if (!empty ($user)) {
        if (password_verify($password, $get_password)) {
            echo "Успешный вход";
            session_start();
            $_SESSION["auth"] = 'true';
                header('Location:admin.php');
        } else
            echo "Неверный пароль";
            header('Location:admin.php');
    } else {
        echo "Неверный логин";
        header('Location:admin.php');
    }
}
else echo"пусто";
mysqli_close($link);
