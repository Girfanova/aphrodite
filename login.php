<?php
session_start();
require_once("connect_db.php");
 mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");

 if (!empty(!empty($_POST['phone_log']) and !empty($_POST['password_log']))){
    $phone = $_POST['phone_log'];
    $password = $_POST['password_log'];

    $query = "SELECT * FROM users WHERE phone = '$phone' and password = '$password'";
    $result = mysqli_query($link, $query);
    $user =  mysqli_fetch_array($result);

    if (!empty($user)){
        echo "Авторизация прошла";
        $_SESSION["auth"] = 'true';
        $_SESSION["user_role"] = $user['role_id'];
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["user_name"] = $user['name'];
        if ($_SESSION['user_role']==10)
            header('Location:admin.php');
        else 
            header('Location:lk.php');
    }
    else {
        echo "<script>
        alert('Неверный логин или пароль');
        document.location.href = '/';
         </script>";
    }
 }
?>