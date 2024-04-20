<?php
if (!empty ($_POST['category_name']) and !empty ($_POST['service_name']) and !empty ($_POST['service_price'])) {
    $price = addslashes($_POST['service_price']);
    $category_name = $_POST['category_name'];
    $service_name = addslashes($_POST['service_name']);
    $service_id = $_POST['service_id'];
    require_once ("connect_db.php");
    $query = "UPDATE services set service='" . $service_name . "', price='".$price."', category_id=$category_name where id=$service_id";
    mysqli_query($link, $query) or die($link);
    echo "Данные обновлены";
    mysqli_close($link);

} else
        echo "Пустые поля";
