<?php
session_start();
require_once("connect_db.php");
if (!empty($_POST['portfolio_description'])) {
    $id = $_POST['portfolio_id'];
    $description = $_POST['portfolio_description'];
    
    $query = "UPDATE portfolio set description= '$description' where id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
    }
