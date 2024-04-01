<?php
require_once ('connect_db.php');
echo '<div class="master-services-block">';
$master_services = mysqli_query($link, 'SELECT * from masters_categories, categories where id_master=' . $_GET['id'] . ' and id=id_category');
echo "Услуги: ";
while ($row = mysqli_fetch_array($master_services)) {
    echo '<div style="display:inline-block; border:black solid 1px; margin:1%;">' . $row['category_name'] . '</div>';
}
echo '</div>';
$schedule = mysqli_query($link, 'SELECT * from schedule where id_master=' . $_GET['id']);
echo "<table class='schedule' >
 <tr>
     <th>День недели</th>
     <th>Начало рабочего дня</th>
     <th>Конец рабочего дня</th>
     <th>Не работает</th>
 </tr>
 <tbody>";

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
                <td  class='td'><input id='start-" . $row["day_of_week"] . "' type=time name='start-" . $row["day_of_week"] . "' value='" . $row['start_of_work'] . "' oninput='red(this);'></td>
                <td class='td'> <input type=time name='end-" . $row["day_of_week"] . "' value='" . $row['end_of_work'] . "' oninput='red(this);'></td>";
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
<script>
    function red(input) {
        input.parentNode.style.backgroundColor = '#ffb0b073';
    };
    function change_work(input) {
        if (input.classList.contains('check')){
            input.value = 2;
            input.parentNode.style.backgroundColor = '#ffb0b073';

            // input.parentNode.parentNode.style.backgroundColor = 'white';
            input.classList.remove('check');
            input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
                element.readOnly = false;
                });;
        }
        else {
            input.value = 1;
             input.parentNode.style.backgroundColor = '#ffb0b073';
            // input.parentNode.parentNode.style.backgroundColor = '#e7e6e6';
            input.classList.add('check');
            input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
                element.readOnly = true;
                });;
        }
    };
    $('document').ready(function () {
        var checked = document.querySelectorAll('.checkbox');
        for (let input of checked){
            if (input.classList.contains('check')){
                input.parentNode.parentNode.style.backgroundColor = '#e7e6e6';
                input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
                    element.readOnly = true;
                });;

            }
            else {
                input.parentNode.parentNode.style.backgroundColor = 'white';
        }
        }
       
    })
</script>