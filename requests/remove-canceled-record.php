<?php
	require_once("connect_db.php");

    // получить дату время мастера
    $query = 'SELECT * FROM records WHERE id='.$_POST['id'];
    $result = mysqli_query($link,$query) or die($link);
    $record = mysqli_fetch_assoc($result);
    $master = $record['master_id'];
    $date = $record['date_record'];
    $time_start = $record['time_record'];
    $time_end = $record['time_end_record'];

    // посмотреть есть ли уже запись в это время
    $records = mysqli_query($link, "SELECT * from records where master_id=" . $master . " and date_record='" . $date . "' and canceled=0 and ((time_record >= '".$time_start."' and time_record <= '".$time_end."') or (time_end_record <= '".$time_end."' and time_end_record >='" . $time_start."'))");
//    echo"SELECT * from records where master_id=" . $master . " and date_record='" . $date . "' and canceled=0 and ((time_record >= '".$time_start."' and time_record <= '".$time_end."') or (time_end_record <= '".$time_end."' and time_end_record >='" . $time_start."'))";

    // если да сказать занято
    if (mysqli_num_rows($records)) echo '0';
    // усли нет восстановить
    else{
        echo "1";
        $zapros="UPDATE records SET canceled=0 Where id=".$_POST['id'];
        mysqli_query($link,$zapros) or die($link);
    }
	mysqli_close($link);
