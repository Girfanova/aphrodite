<?php
session_start();
// var_dump($_POST);
require_once("connect_db.php");
$id = $_POST['id'];
// $start0 = $_POST['start-0'];
// $end0 = $_POST['end-0'];
// $start1 = $_POST['start-1'];
// $end1 = $_POST['end-1'];
// $start2 = $_POST['start-2'];
// $end2 = $_POST['end-2'];
// $start3 = $_POST['start-3'];
// $end3 = $_POST['end-3'];
// $start4 = $_POST['start-4'];
// $end4 = $_POST['end-4'];
// $start5 = $_POST['start-5'];
// $end5 = $_POST['end-5'];
// $start6 = $_POST['start-6'];
// $end6 = $_POST['end-6'];
// echo $id;
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
//    while ($row = mysqli_fetch_array($category_id)){
//     $cat_id = $row["id"];
//    };
//    print_r($_POST);
//    echo "$cat_id";
// $query="UPDATE services set service='".$service_name."', price=$price, category_id=$cat_id,duration_in_min=$service_duration, is_recording=$service_recording where id=$service_id";
// mysqli_query($link, $query);
// echo"Данные обновлены";
// echo "<script>

// document.location.href = 'admin-panel.php';
// </script>";
return false;
