<?php
session_start();
 $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
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