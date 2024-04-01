<?php
require_once("connect_db.php");
// получение id категории выбранной услуги и длительность услуги
$category_id = mysqli_fetch_row(mysqli_query($link, "SELECT category_id from services where id=" . $_GET["service_id"]))[0];
$service_duration = mysqli_fetch_row(mysqli_query($link, "SELECT duration_in_min from services where id=" . $_GET["service_id"]))[0];

// получение id мастеров, отвечающих за выбранную категорию услуг
$masters = mysqli_query($link, "SELECT id_master from masters_categories where id_category=$category_id");
while ($master_id = mysqli_fetch_array($masters)) {
    //получнеие графика работы мастера в выбранный день недели 
    $schedule_master = mysqli_fetch_row(mysqli_query($link, "SELECT not_work, start_of_work, end_of_work from schedule where id_master=" . $master_id[0] . " and day_of_week=" . $_GET['day_of_week'])); 
    if ($schedule_master[0] != 1) { //если мастер работает в этот день, получаем его id и время работы
        $free_master = $master_id[0];
        $start_of_work = $schedule_master[1];
        $end_of_work = $schedule_master[2];
        break;
    }
}
//если есть свободный мастер
if (isset($free_master)) {
    $start = date("H:i", strtotime($start_of_work)); 
    $end = date("H:i", strtotime($end_of_work));

    $schedule = [];
    while (strtotime($start) < strtotime($end)) {
        $schedule[] = $start;
        $start = date("H:i", strtotime("+ 60 minutes", strtotime($start)));
    }
    $records = mysqli_query($link, "SELECT * from records where master_id=" . $free_master . " and date_record='" . $_GET['date'] . "' and canceled=0");

    while ($record = mysqli_fetch_array($records)) {
        foreach ($schedule as $key => $start_time) {
            if (strtotime($start_time) >= strtotime($record['time_record']) and strtotime($start_time) <= strtotime($record['time_end_record'])) {
                unset($schedule[$key]);
            }
        }
    }
    if ($schedule) {
        foreach ($schedule as $value) {
            echo "<option>$value</option>";
        };
        echo '<script> document.getElementById("master_id").value = "'.$free_master.'";</script>';
    } else {
        echo "<option>Нет записи</option>";
    }
} else
    echo "<option>Нет записи</option>";
    mysqli_close($link);




