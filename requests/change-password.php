<?php
session_start();
if (isset($_SESSION['user_id']) and isset($_POST['password'])) {
    require_once ('connect_db.php');
    $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
    $query = "UPDATE users set users.password = '{$password}' where id={$_SESSION['user_id']}";
    mysqli_query($link, $query);
    mysqli_close($link);
    echo 'Пароль успешно изменен';
} else
    echo "Пустые поля";