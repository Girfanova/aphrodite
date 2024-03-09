<?php
session_start();
require_once("connect_db.php");
if (!empty($_POST['category_name']) and !empty($_POST['service_name']) and !empty($_POST['price'])) {
    $price = $_POST['price'];
    $category_name = $_POST['category_name'];
    $service_name = $_POST['service_name'];
    $service_duration = $_POST['duration'];
    $service_recording = $_POST['is_recording'];
    $category_id = mysqli_query($link, "SELECT id from categories where category_name='" . $category_name . "'");
    while ($row = mysqli_fetch_array($category_id)) {
        $cat_id = $row["id"];
    }
    ;
    echo "$cat_id";
    $query = "INSERT INTO services SET service = '$service_name', price = '$price', category_id = '$cat_id', duration_in_min=$service_duration, is_recording=$service_recording";
    mysqli_query($link, $query);

    echo "<script>
            
            document.location.href = 'admin-panel.php';
            </script>";

} else
    echo "<script>
    alert('Пустые поля');
    </script>";

