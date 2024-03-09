<?php
    session_start();
    require_once("connect_db.php");
    if (!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['phone_reg']) and !empty($_POST['password_reg'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone_reg'];
        $password = $_POST['password_reg'];
        
        $query = "SELECT * FROM users WHERE phone = '$phone'";
        $user = mysqli_fetch_array( mysqli_query($link, $query));

        if (empty($user)){
            $query="INSERT INTO users SET name = '$name', surname = '$surname', phone = '$phone', password = '$password', role_id = '1'";
            mysqli_query($link, $query);
            $user=mysqli_fetch_array( mysqli_query($link,"SELECT * FROM users WHERE phone = '$phone' and password = '$password'"));
            $_SESSION['auth'] = true;
            $_SESSION["user_role"]  = '1';
            $_SESSION['user_id']= $user['id'];
            echo "<script>
            alert('Успешная регистрация');
            document.location.href = 'lk.php';
            </script>";
        }
        else{
            echo "<script>
                    alert('Этот номер уже зарегистрирован');
                    document.location.href = '/';
                </script>";
           
        }
    }

 ?>