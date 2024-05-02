<?php
require('connect_db.php');

$schedule = mysqli_query($link, 'SELECT * from schedule where id_master=' . $_SESSION['user_id']. ' ORDER BY day_of_week = 0 ASC, day_of_week ASC');
echo " <div class='admin-menu'>
<table class='schedule' >
 <tr>
     <th>День недели</th>
     <th>Начало рабочего дня</th>
     <th>Конец рабочего дня</th>
 </tr>
 <tbody>";

while ($row = mysqli_fetch_array($schedule)){
    if ($row['not_work'] == 1)
    echo "<tr class='disabled'>";
else
    echo "<tr>";
    switch ($row["day_of_week"]) {
        case "1":
            $day = 'ПН';
            break;
        case '2':
            $day = 'ВТ';
            break;
        case '3':
            $day = 'СР';
            break;
        case '4':
            $day = 'ЧТ';
            break;
        case '5':
            $day = 'ПТ';
            break;
        case '6':
            $day = 'СБ';
            break;
        case '0':
            $day = 'ВС';
            break;
    }
    echo "<td>" . $day . "</td>
                <td  class='td'>" . $row['start_of_work'] . "</td>
                <td class='td'>" . $row['end_of_work'] . "</td>";
    echo "</tr>";
}
echo " </tbody>

</table>
</div>"; 
mysqli_close($link);