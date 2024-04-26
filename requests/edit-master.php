<?php
require('connect_db.php');
$query = 'SELECT * FROM `specialties`';
$result = mysqli_query($link, $query) or die($link);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($rows);
mysqli_close($link);

