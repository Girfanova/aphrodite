<?php
if (!empty($_POST['portfolio_description'])) {
    $id = $_POST['id'];
    $description = $_POST['portfolio_description'];
    require_once("connect_db.php");
    $query = "UPDATE portfolio set description= '$description' where id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
} else
    echo "<script>
    alert('Пустые поля');
    </script>";