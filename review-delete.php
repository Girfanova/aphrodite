<?php
if (isset($_POST['id'])){
    $query = "DELETE FROM reviews where id=".$_POST['id'];
    require_once('connect_db.php');
    mysqli_query($link, $query) or die('Ошибка');
    mysqli_close($link);
}