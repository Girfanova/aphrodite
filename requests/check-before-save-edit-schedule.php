<?php
require_once('connect_db.php');
$id = $_POST['id'];

$k = 0;
$response = [];
// $today = date('Y-m-d');
$date_arr = [];
while($k<=6){
    $today = date('Y-m-d', strtotime("+$k day"));
    $weekday_n = date("w", mktime(0, 0, 0, date("m"), date("d") + $k, date("Y")));
    $date_arr[$weekday_n] =  $today;
    $k++;
}
$k=0;
while ($k <= 6) {
    $date = $date_arr[$k]; // дата на ближайшую неделю (день недели $k)
    $time_start = $_POST['start-'.$k];
    $time_end = $_POST['end-'.$k];
    if ($_POST['not-work-'. $k] == 0){
        $query = "SELECT id FROM records WHERE date_record = '$date' and ('$time_start' > time_record or '$time_end' < time_end_record) and master_id=$id and canceled=0";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result)!=0) {
            while($row = mysqli_fetch_array($result)){
                $response[] = [$k, $row['id']];
            }
        }
    }
    else {
        $query = "SELECT id FROM records WHERE date_record = '$date' and master_id=$id and canceled=0";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result)!=0) {
            while($row = mysqli_fetch_array($result)){
                $response[] = [$k, $row['id']];
            }
        }
    }
    // $query="UPDATE schedule set start_of_work='".$_POST['start-'.$k]."', end_of_work='".$_POST['end-'.$k]."', not_work=".$work." where id_master=$id and day_of_week=".$k."";  
    $k++;
}
if (count($response)==0) echo json_encode('success');
else echo json_encode($response);
mysqli_close($link);