<?php
require_once('connect_db.php');
$master_id = $_POST['master_id'];
$date_record = $_POST['date_record'];
$time_record = $_POST['time_record']. ":00";
$id = $_POST['record_id'];


$query = "SELECT services.duration_in_min FROM records, services WHERE records.id=$id and service_id=services.id";
$res = mysqli_query($link, $query);
$duration = mysqli_fetch_array($res)[0];
$oldTime = strtotime($time_record);
$time_end_record = date("H:i:s", strtotime('+'.$duration.' minutes', $oldTime));

$query = "UPDATE records SET master_id = '$master_id', date_record = '$date_record', time_record = '$time_record', time_end_record = '$time_end_record' where id ='$id'";
mysqli_query($link, $query) or die($link);

$query = "SELECT concat(name, ' ', surname) as master_name from masters where id = '$master_id'";
$result = mysqli_query($link, $query) or die($link);
echo mysqli_fetch_array($result)[0];

mysqli_close($link);
?>