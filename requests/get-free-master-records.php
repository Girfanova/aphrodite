<?php
require_once("connect_db.php");
// получение id категории выбранной услуги и длительность услуги
// $spec_id = mysqli_fetch_row(mysqli_query($link, "SELECT specialization_id FROM categories, services WHERE categories.id = services.category_id and services.id=" . $_POST["service_id"] ))[0];
$service_duration = mysqli_fetch_row(mysqli_query($link, "SELECT duration_in_min from services where id=" . $_POST["service_id"]))[0];

// получение id мастеров, отвечающих за выбранную категорию услуг
// $masters = mysqli_query($link, "SELECT id from masters where specialization_id=$spec_id");
// while ($master_id = mysqli_fetch_array($masters)) {
    //получнеие графика работы мастера в выбранный день недели 
    $schedule_master = mysqli_fetch_row(mysqli_query($link, "SELECT not_work, start_of_work, end_of_work from schedule where id_master=" . $_POST['master_id'] . " and day_of_week=" . $_POST['day_of_week'])); 
    if ($schedule_master[0] != 1) { //если мастер работает в этот день, получаем его id и время работы
        $start_of_work = $schedule_master[1];
        $end_of_work = $schedule_master[2];
        // break;
    }
// }
//если есть свободный мастер
// if (isset($free_master)) {
    $start = date("H:i", strtotime($start_of_work)); 
    $end = date("H:i", strtotime($end_of_work));

    //массив времени с интервалом 0,5 час
    $schedule = [];
    while (strtotime("+$service_duration minutes", strtotime($start)) < strtotime($end)) {
        $schedule[] = $start;
        $start = date("H:i", strtotime("+ 30 minutes", strtotime($start)));
    //    echo strtotime("+$service_duration minutes", strtotime($start));
    //    echo strtotime("+$service_duration minutes", strtotime($start)), " " , strtotime($end), " -" , $service_duration, " <br>";
    }
    // список действующих записей на этот день 
    $records = mysqli_query($link, "SELECT * from records where master_id=" . $_POST['master_id'] . " and date_record='" . $_POST['date'] . "' and canceled=0");

    //перезапись массива со временем, если в интервал времени уже есть запись, удаляем его из массива
    while ($record = mysqli_fetch_array($records)) {
        foreach ($schedule as $key => $start_time) {
            if (strtotime($start_time) >= strtotime($record['time_record']) and strtotime($start_time) < strtotime($record['time_end_record'])) { 
                unset($schedule[$key]);
            }
        }
    }
    $sch = [];
    if ($schedule) {
        foreach ($schedule as $value) {
            $sch[] = "<option>$value</option>";
        };
    } else {
        $sch = "<option>Нет записи</option>";
    }
// } else
//     echo "<option>Нет записи</option>";
    mysqli_close($link);
    echo json_encode($sch);




