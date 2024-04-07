<?php
require_once('connect_db.php');
$query = 'SELECT * from reviews where id='. $_POST['id'];
$result = mysqli_fetch_assoc(mysqli_query($link, $query));
mysqli_close($link);
echo json_encode($result);