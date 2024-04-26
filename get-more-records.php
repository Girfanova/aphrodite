<?php
require_once ("connect_db.php");
$id_master = $_GET['select'];
$offset = $_GET['offset'];
$today = getdate();
$date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
if ($id_master == '000') {
    $records = mysqli_query($link, "Select distinct
                    (select phone from users where users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from masters where masters.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id
                    order by date_record desc") or die($link);
} else {
    $records = mysqli_query($link, "Select distinct
                    (select phone from users where users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from masters where masters.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id and master_id=$id_master
                    order by date_record desc") or die($link);
}
mysqli_close($link);
$k = 1;
while ($stroka = mysqli_fetch_array($records)) {
    if ($k > $offset and $k <= $offset + 10) {
        echo "<tr>";
        echo "<td > {$stroka['Клиент']} </td>";
        echo "<td > {$stroka['Телефон клиента']} </td>";
        echo "<td > {$stroka['Мастер']} </td>";
        echo "<td > {$stroka['Услуга']} </td>";
        echo "<td >" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
        echo "<td > " . date('H.i', strtotime($stroka['Время'])) . "</td>";
        if ($stroka['canceled'] == 0 && $stroka['done'] == 0)
            echo "<td  align='center'><a href='canceled-record.php?id=" . $stroka['id'] . "&date=" . $stroka['Дата'] . "&time=" . $stroka['Время'] . "&master=" . $stroka['Мастер'] . "'><img src='Resources/canceled.png'></img></a></td>";
        elseif ($stroka['canceled'] == 1)
            echo '<td>Отменено</td>';
        else
            echo '<td>-</td>';
        if ($stroka['done'] == 0 && $stroka['canceled'] == 0)
            echo "<td  align='center'><a href='done-record.php?id=" . $stroka['id'] . "'><img src='Resources/done.png'></img></a></td>";
        elseif ($stroka['done'] == 1)
            echo '<td>Выполнено</td>';
        else
            echo '<td>-</td>';
        echo "</tr>";
    }
    $k++;
}
?>