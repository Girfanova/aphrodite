<?php
var_dump($_POST);
if (!empty($_POST['id']) and !empty($_POST['role_id'])){
    require_once("connect_db.php");
    $us_id = $_POST['id'];
    $role_id = $_POST['role_id'];
    $query = "SELECT * from users where id=". $us_id;
    $result_us = mysqli_query($link, $query);
    $user_db = mysqli_fetch_assoc($result_us);
    if ($user_db['role_id'] == 2){
        echo "Удаляем из таблицы мастера и все записи, связанные с ним";

    }
    if ($role_id == 2){
        echo "Добавляем мастера в таблицу мастера, добавляем его расписание в таблицу расписания";
        mysqli_query($link, "INSERT INTO masters values (".$user['id'].",".$user_db['surname'].", ".$user_db['name'].")");
    }
    $query='UPDATE users set role_id='.$role_id.' where id='.$us_id;

    mysqli_query($link,$query);
    mysqli_close($link);
}