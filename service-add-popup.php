<?php
require ("connect_db.php");
$categories = mysqli_query($link, 'SELECT id, category_name FROM `categories`') or die($link);
$cat = [];
while ($category = mysqli_fetch_array($categories)) {
    array_push($cat, array($category['category_name'], $category['id']));
}
mysqli_close($link);
echo json_encode($cat);