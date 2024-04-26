<?php
if (!empty ($_POST['category_name']) and !empty ($_POST['service_name']) and !empty ($_POST['service_price'])) {

    $price = addslashes($_POST['service_price']);
    $category_name = $_POST['category_name'];
    $service_name = addslashes($_POST['service_name']);
    $service_id = $_POST['service_id'];
    $service_duration = $_POST['service_duration'];
    $service_recording = $_POST['is_recording'];
    require_once ("connect_db.php");
    echo "UPDATE services set service='$service_name', price= '$price', category_id=$category_name ,duration_in_min=$service_duration, is_recording=$service_recording where id=$service_id";
    $query = "UPDATE services set service='$service_name', price= '$price', category_id=$category_name ,duration_in_min=$service_duration, is_recording=$service_recording where id=$service_id";
    mysqli_query($link, $query) or die($link);
    echo "Данные обновлены";
    mysqli_close($link);

} else
        echo "Пустые поля";
