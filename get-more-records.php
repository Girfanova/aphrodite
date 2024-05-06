<?php
require_once ("connect_db.php");
$id_master = $_GET['select'];
$offset = $_GET['offset'];
$today = getdate();
// $date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
$date= date('Y-m-d');
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
        echo "<tr id='record". $stroka['id'] ."'>";
        echo "<td > {$stroka['Клиент']} </td>";
        echo "<td > {$stroka['Телефон клиента']} </td>";
        echo "<td class='master'> {$stroka['Мастер']} </td>";
        echo "<td > {$stroka['Услуга']} </td>";
        echo "<td class='date'>" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
        echo "<td class='time'> " . date('H.i', strtotime($stroka['Время'])) . "</td>";
        if ($stroka['canceled'] == 0 && $stroka['done'] == 0)
        echo "<td  align='center' class='canceled-btn'><input type='checkbox' onclick='makeCanceledRecord(" . $stroka['id'] . ");'></td>";
    elseif ($stroka['canceled'] == 1)
        echo "<td  align='center' class='canceled-btn'><input type='checkbox' checked onclick='removeCanceledRecord(" . $stroka['id'] . ");'></td>";
    else
        echo "<td  align='center' class='canceled-btn'>&mdash;</td>";
    if ($stroka['done'] == 0 && $stroka['canceled'] == 0)
        echo "<td  align='center' class='done-btn'><input type='checkbox' onclick='makeDoneRecord(" . $stroka['id'] . ");'></td>";
    elseif ($stroka['done'] == 1)
        echo "<td  align='center' class='done-btn'><input type='checkbox' checked onclick='removeDoneRecord(" . $stroka['id'] . ");'></td>";
    else
    echo "<td align=center class='done-btn'>&mdash;</td>";
if (($stroka['Дата']) >= $date )
echo "<td align=center><a class='re-record' onclick='recordEdit(".$stroka['id'].")'>Перенести</a></td>";
else 
echo "<td align=center>&mdash;</td>";
    echo "</tr>";
    }
    $k++;
}
?>