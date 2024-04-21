<?php
if (!empty ($_POST['category_name']) and !empty ($_POST['service_name']) and !empty ($_POST['service_price'])) {
    //получение данных
    $price = addslashes($_POST['service_price']);
    $category_id = $_POST['category_name'];
    $service_name = addslashes($_POST['service_name']);
    $service_duration = $_POST['service_duration'];
    $service_recording = $_POST['is_recording'];
    //подключение к БД
    require_once ("connect_db.php");
    //формирование и выполнение запроса
    $query = "INSERT INTO services SET service = '$service_name', price = '$price', category_id = '$category_id', duration_in_min=$service_duration, is_recording=$service_recording";
    mysqli_query($link, $query) or die($link);
    //закрытие подключения к БД
    mysqli_close($link);
    echo "Услуга добавлена";

} else
    echo "Пустые строки";

