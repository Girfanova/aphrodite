<?php
session_start();
if (isset($_SESSION['user_id']) and isset($_POST['password'])){
    require_once('connect_db.php');
    $query="SELECT password from users where id={$_SESSION['user_id']}";
    $result = mysqli_query($link, $query);
    $password = mysqli_fetch_assoc($result)['password'];
    mysqli_close($link);
    if (password_verify($_POST['password'], $password)){
       echo true;
    }
    else echo false;
}
else echo "Пустые поля";