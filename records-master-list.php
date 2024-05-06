<?php
        if ($_SESSION["user_role"] == 2) {

            
            echo "<div class='admin-menu'>";
            
            require('connect_db.php');
            
            echo "<table class='record-table' id='record-table'>";
            echo "<tr>
            <th width=22%>Услуга</th>
            <th width=10%>Дата</th>
            <th width=7%>Время</th>
            <th width=14%>Клиент</th>
                   <th width=15%>Телефон клиента</th>
                   <th width=9%>Статус</th>
                   </tr>";
                echo '<tbody id="record-list-table" width=100%></tbody>';
$today = getdate();
$date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
    $records = mysqli_query($link, "Select distinct (select phone from users where users.id=user_id) as 'Телефон клиента', (select concat(name, ' ', surname) from users where users.id=user_id) as Клиент, (select concat(name, ' ',surname) from masters where masters.id=master_id) as Мастер, service as Услуга, date_record as Дата, time_record as Время, records.id, done, canceled from users, roles, records, services, masters where services.id = service_id and masters.id=".$_SESSION['user_id']." and records.master_id=masters.id order by date_record desc;");

while ($stroka = mysqli_fetch_array($records)) {
    echo "<tr id='record" . $stroka['id'] . "'>";
    echo "<td > {$stroka['Услуга']} </td>";
    echo "<td >" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
    echo "<td > " . date('H.i', strtotime($stroka['Время'])) . "</td>";
    echo "<td > {$stroka['Клиент']} </td>";
    echo "<td > {$stroka['Телефон клиента']} </td>";
    if ($stroka['canceled'] == 0 && $stroka['done'] == 0)
        echo "<td  align='center' class='canceled-btn'>В ожидании</td>";
    elseif ($stroka['canceled'] == 1)
        echo "<td  align='center' class='canceled-btn'>Отменена</td>";
    else
        echo "<td  align='center' class='canceled-btn'>Выполнена</td>";
    
    echo "</tr>";
}
mysqli_close($link);

if (mysqli_num_rows($records) == 0)
    echo "<tr><td colspan=9 align='center'>Записей на ближайшее время нет</td></tr>";

            echo '</table>';

            echo '</div>';
        }
