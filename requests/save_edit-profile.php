<?php
    require_once("connect_db.php");
    session_start();
    if (!empty($_POST['surname_edit']) and !empty($_POST['name_edit'])){
        $id_user = $_SESSION['user_id'];
        $surname = $_POST['surname_edit'];
        $name = $_POST['name_edit'];
        $phone = $_POST['phone_edit'];
            
            $user = mysqli_fetch_array(mysqli_query($link, "SELECT name, surname, phone from users WHERE id='$id_user'"));
            $phoneDB = mysqli_fetch_array(mysqli_query($link, "SELECT phone from users WHERE phone='$phone' and id<>".$_SESSION['user_id']));
            
            
            if (!empty($phoneDB)) {
                echo "<script>
                alert('Номер телефона уже зарегистрирован');
                document.location.href = '../edit-profile.php';
                </script>";
            }
            elseif ($user['surname'] != $surname || $user['name'] != $name || $user['phone'] != $phone){
            $query="UPDATE users SET surname = '$surname', name = '$name', phone='$phone' WHERE id='$id_user'";
            mysqli_query($link, $query);
            echo "<script>
            alert('Данные сохранены');
            document.location.href = '../lk.php';
            </script>";
            }
            else {
                echo "<script>
            alert('Вы не внесли изменений');
            document.location.href = '../edit-profile.php';
            </script>";
            }
    }
    mysqli_close($link);
 ?>