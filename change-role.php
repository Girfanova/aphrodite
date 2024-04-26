<?php
if (!empty($_POST['id']) and !empty($_POST['role_id'])) {
    require_once ("connect_db.php");
    $us_id = $_POST['id'];
    $role_id = $_POST['role_id'];
    $query = "SELECT * from users where id=" . $us_id;
    $result_us = mysqli_query($link, $query);
    $user_db = mysqli_fetch_assoc($result_us);
    if ($user_db['role_id'] == 2) {
        // Удаляем из таблицы мастера, расписание и все записи, связанные с ним
        mysqli_query($link, "DELETE FROM schedule where id_master=" . $us_id) or die($link);
        mysqli_query($link, "DELETE FROM records where master_id=" . $us_id) or die($link);
        mysqli_query($link, "DELETE FROM masters where id='".$us_id."'") or die($link);
    }
    if ($role_id == 2) {
        //Добавляем мастера в таблицу мастера, добавляем его расписание в таблицу расписания
        mysqli_query($link, "INSERT INTO masters values (" . $us_id . ", '" . $user_db['surname'] . "', '" . $user_db['name'] . "', NULL)") or die($link);
        $k = 0;
        while ($k <= 6) {
            mysqli_query($link, "INSERT INTO schedule values (" . $us_id . ", " . $k . ", '00:00:00', '00:00:00', 1)") or die($link);
            $k++;
        }
    }
    $query = 'UPDATE users set role_id=' . $role_id . ' where id=' . $us_id;

    mysqli_query($link, $query);
    mysqli_close($link);
}