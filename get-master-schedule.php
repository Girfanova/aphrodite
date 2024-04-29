<?php
require_once ('connect_db.php');
echo '<div class="master-services-block">';
$master_services = mysqli_query($link, 'SELECT specialties.name as name, phone from masters, specialties, users where masters.id=' . $_GET['id'] . ' and specialization_id=specialties.id and masters.id = users.id') or die($link);
while ($row = mysqli_fetch_array($master_services)) {
    echo "Телефон: ";
    echo '<div style="display:inline-block;">' . $row['phone'] . '</div><br>';
    echo "Специализация: ";
    echo '<div id="spec" style="display:inline-block;">' . $row['name'] . '</div>';
}
echo "
<a onclick='get_info_master();' class='edit-category'><span class='material-symbols-outlined'>edit</span></a>

";
echo '</div>';
$schedule = mysqli_query($link, 'SELECT * from schedule where id_master=' . $_GET['id']. ' ORDER BY day_of_week = 0 ASC, day_of_week ASC');
echo "<table class='schedule' >
 <tr>
     <th>День недели</th>
     <th>Начало рабочего дня</th>
     <th>Конец рабочего дня</th>
     <th>Не работает</th>
 </tr>
 <tbody>";

while ($row = mysqli_fetch_array($schedule)){
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
                <td  class='td'><input id='start-" . $row["day_of_week"] . "' type=time name='start-" . $row["day_of_week"] . "' value='" . $row['start_of_work'] . "' ></td>
                <td class='td'> <input type=time name='end-" . $row["day_of_week"] . "' value='" . $row['end_of_work'] . "' ></td>";
    if ($row['not_work'] == 0)
        echo " <td> <input  class='checkbox' type=checkbox name='not-work-" . $row["day_of_week"] . "' value=2 onchange='change_work(this);'></td>";
    else
        echo " <td> <input  class='check checkbox' type=checkbox name='not-work-" . $row["day_of_week"] . "' value=1 checked onchange='change_work(this);'></td>";
    echo "<td><input type='hidden' name='id' value='" . $_GET['id'] . "'></td>";
    echo "</tr>";
}
echo " </tbody>

</table>"; 
mysqli_close($link);
?>
