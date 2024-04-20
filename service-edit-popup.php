<?php
require_once ("connect_db.php");
if (isset($_POST["id"])) {
    $service_id = $_POST['id'];
    $services = mysqli_query($link, 'SELECT category_id, service, price, category_name, duration_in_min, is_recording FROM services, categories where services.id=' . $service_id);
    while ($row = mysqli_fetch_array($services)) {
        $service_name = $row['service'];
        $service_price = $row['price'];
        $service_category_id = $row['category_id'];
        $service_duration = $row['duration_in_min'];
        $service_recording = $row['is_recording'];
    }
    $category_arr = [];
    $categories = mysqli_query($link, 'SELECT id, category_name FROM `categories`');
    while ($category = mysqli_fetch_array($categories)) {
        if ($category['id'] == $service_category_id)
            array_push($category_arr, array($category['category_name'], $category['id'], 'selected')) ;
        else
            array_push($category_arr, array($category['category_name'], $category['id'],  'not-selected')) ;
    }
}
echo json_encode(array('id' => $service_id, 'name' => $service_name, 'price' => $service_price, 'categories' => $category_arr));
