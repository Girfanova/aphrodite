<?php
require_once("connect_db.php");
$zapros = "UPDATE records SET done=0 Where id=" . $_POST['id'];
mysqli_query($link, $zapros) or die($link);
mysqli_close($link);