<?php
if (isset($_POST['date-record'])) {
    require_once("connect_db.php");
    $date = $_POST['date-record'];
    $times = mysqli_query($link, 'SELECT time_record, time_end_record FROM records where date_record=' . $date);
    if (!empty($tmes)) {
        $record_time = mysqli_fetch_array($times);
        $freetime = [];
        $day_of_week = date('w', $date);
        $selected_master_schedule = mysqli_query($link, "SELECT * FROM schedule WHERE id_master =1 and day_of_week=".$day_of_week);
        $schedule = [];
        while ($stroka = mysqli_fetch_array($selected_master_schedule)) { 
            $start_of_day = date($stroka["start_of_work"]);
            $end_of_day = date($stroka["end_of_work"]);
        }


    }

    echo json_encode(array('$time'));
} else {
    echo json_encode(array('success' => 0));
}