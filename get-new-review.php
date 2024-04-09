<?php
require_once ('connect_db.php');
var_dump($_POST);
$query = "SELECT * from reviews where id=". $_POST['id'];
$result = mysqli_query($link, $query) or die("Ошибка");
mysqli_close($link);
echo json_encode($result);
echo "Отзыв добавлен";
