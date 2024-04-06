<?php
require('connect_db.php');
$query = 'SELECT * FROM `masters`, `masters_categories`, `categories` WHERE masters.id = '.$_POST['id'].' and masters.id = masters_categories.id_master and categories.id = masters_categories.id_category;';
// $query = 'SELECT * FROM `masters`, `masters_categories`, `categories` WHERE masters.id = 33 and masters.id = masters_categories.id_master and categories.id = masters_categories.id_category;';
$result = mysqli_query($link, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($rows);
mysqli_close($link);

