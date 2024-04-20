<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $description = addslashes($_POST['portfolio_description']);
    require_once("connect_db.php");
    $query = "UPDATE portfolio set description = '".$description."' where id='".$id."'";
    mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
} 