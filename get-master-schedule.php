<?php
require_once('connect_db.php');
 $schedule = mysqli_query($link, 'SELECT * from schedule where id_master=1');
while ($row = mysqli_fetch_array($schedule)) {
    echo "<tr>";
    switch ($row["day_of_week"]) {
        case "0":
            $day = 'ПН';
            break;
        case '1':
            $day = 'ВТ';
            break;
        case '2':
            $day = 'СР';
            break;
        case '3':
            $day = 'ЧТ';
            break;
        case '4':
            $day = 'ПТ';
            break;
        case '5':
            $day = 'СБ';
            break;
        case '6':
            $day = 'ВС';
            break;
    }
    echo "<td>" . $day . "</td>
                <td><input type=time value='" . $row['start_of_work'] . "'></td>
                <td> <input type=time value='" . $row['end_of_work'] . "'></td>";
    echo "</tr>";
}
