<?php

require_once ("connect_db.php");

if (!empty (!empty ($_POST['phone_log']) and !empty ($_POST['password_log']))) {
    $phone = $_POST['phone_log'];
    $password = $_POST['password_log'];
    $query = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_array($result);
    $get_password = $user['password'];
    $p = password_hash($password, PASSWORD_ARGON2I);
    if (!empty ($user)) {
        if (password_verify($password, $get_password)) {
            session_start();
            $_SESSION["auth"] = 'true';
            $_SESSION["user_role"] = $user['role_id'];
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["user_name"] = $user['name'];
            echo 'Успешный вход';
        } else
            echo "Неверный пароль";
    } else {
        echo "Неверный логин";
    }
}
mysqli_close($link);