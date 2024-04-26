<?php
session_start();
require_once("connect_db.php");
$id = $_POST['id'];

$k = 0;
$schedule = [];
while ($k <= 6) {
    $schedule[$k] = [$_POST['start-'.$k], $_POST['end-'.$k]];
    if ($_POST['not-work-'. $k] == 1) $work = 1;
    else $work = 0;
    
    $query="UPDATE schedule set start_of_work='".$_POST['start-'.$k]."', end_of_work='".$_POST['end-'.$k]."', not_work=".$work." where id_master=$id and day_of_week=".$k."";
    
    mysqli_query($link, $query);
    $k++;
}
echo 'График обновлен';
mysqli_close($link);

return false;
