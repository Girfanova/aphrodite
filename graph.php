<?php
require ("connect_db.php");
$schedule_db = mysqli_query($link, 'SELECT specialties.name as spec, concat(masters.surname , " ", masters.name) as master_name, day_of_week, start_of_work, end_of_work
    FROM `specialties`,`masters`, `schedule` 
    WHERE specialties.id = masters.specialization_id and masters.id = schedule.id_master and schedule.not_work=0 
    ');
$specialties = mysqli_query($link, 'SELECT name FROM `specialties`;');
$new_schedule = [];
$new_spec = [];
while ($schedule = mysqli_fetch_array($schedule_db)) {
    $new_schedule[] = [
        'master_name' => $schedule['master_name'],
        'spec' => $schedule['spec'],
        'day_of_week' => $schedule['day_of_week'],
        'start_of_work' => $schedule['start_of_work'],
        'end_of_work' => $schedule['end_of_work']
    ];
}
while ($spec = mysqli_fetch_array($specialties)) {
    array_push($new_spec, $spec['name']);
}

$new_array1 = array();
foreach ($new_spec as $sp) {
    foreach ($new_schedule as $sc) {
        if ($sc['spec'] == $sp)
            for ($i = 0; $i <= 6; $i++) {
                if ($sc['day_of_week'] == $i)
                    $new_array1[$sp][$i][$sc['master_name']] = array($sc['start_of_work'], $sc['end_of_work']);
            }
    }
}
?>
<div class="admin-menu">

    <table class="record-table graph">
        <tr>
            <th>Категория</th>
            <?php
            for ($i = 0; $i <= 6; $i++) {
                $today = date('d.m', strtotime("+$i day"));
                $weekday_n = date("w", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")));
                switch ($weekday_n) {
                    case 1:
                        $weekday = 'ПН';
                        break;
                    case 2:
                        $weekday = 'ВТ';
                        break;
                    case 3:
                        $weekday = 'СР';
                        break;
                    case 4:
                        $weekday = 'ЧТ';
                        break;
                    case 5:
                        $weekday = 'ПТ';
                        break;
                    case 6:
                        $weekday = 'СБ';
                        break;
                    case 0:
                        $weekday = 'ВС';
                        break;
                }
                echo "<th>$today<br>$weekday</th>";
            }

            ?>
        </tr>

        <?php
        $weekday_n = date("w", mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")));
        foreach ($new_array1 as $key => $spec) {
            echo "<tr>
            <td>" . $key . "</td>";
            for ($i = $weekday_n; $i <= 6; $i++) {
                echo "<td>";
                foreach ($spec[$i] as $master => $times) {
                    echo "<div class='graph-master'><b>$master</b><br><i>".substr($times[0],0,5)." - ".substr($times[1],0,5)."</i></div>";
                }
                echo "</td>";
            }
            for ($i = 0; $i < $weekday_n; $i++) {
                echo "<td>";
                foreach ($spec[$i] as $master => $times) {
                    echo "<div class='graph-master'><b>$master</b><br><i>".substr($times[0],0,5)." - ".substr($times[1],0,5)."</i></div>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>

        <?php

        echo "<script>console.log(" . json_encode($new_schedule) . ");</script>";
        echo "<script>console.log(" . json_encode($new_spec) . ");</script>";
        echo "<script>console.log(" . json_encode($new_array) . ");</script>";
        echo "<script>console.log(" . json_encode($new_array1) . ");</script>";
        ?>

    </table>

</div>