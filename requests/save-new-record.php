<?php
session_start();
require_once("connect_db.php");
var_dump($_POST);
if (!empty($_POST['date-record']) and !empty($_POST['record-time']) and !empty($_POST['service_id']) and !empty($_POST['master_id'])) {
    $id_user = $_SESSION['user_id'];
    $date = $_POST['date-record'];
    $time = $_POST['record-time'] . ":00";
    $service = $_POST['service_id'];
    $master = $_POST['master_id'];
 
    $query = "SELECT * from services where id = '$service'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $duration = $row['duration_in_min'];
    $oldTime = strtotime($time);
    $newTime = date("H:i:s", strtotime('+'.$duration.' minutes', $oldTime));
    $query = "INSERT INTO records SET user_id = '$id_user', master_id = '$master', service_id = '$service', date_record = '$date', time_record = '$time', time_end_record = '$newTime'";
    mysqli_query($link, $query);

} 
mysqli_close($link);
