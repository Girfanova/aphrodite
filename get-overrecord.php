<?php
require_once ("connect_db.php");
$arr = array();
$arr = $_POST['recordsID'];
$rec = [];
foreach($arr as $id){
    $records = mysqli_query($link, "Select distinct
    (select phone from users where users.id=user_id) as 'Телефон клиента', 
    (select concat(name, ' ', surname) from users where users.id=user_id) as Клиент, 
    (select concat(name, ' ',surname) from masters where masters.id=master_id) as Мастер,  
    service as Услуга, 
    master_id,
    date_record as Дата,
    time_record as Время,
    records.id,
    done,
    canceled
    from users, roles, records, services
    where services.id = service_id and records.id = $id
    order by date_record asc") or die($link);
    $rec[] = mysqli_fetch_assoc($records);
}
foreach ($rec as $stroka) {
    $masters = mysqli_query($link, 'SELECT id, concat (name , " ", surname) as master_name from masters WHERE specialization_id =
    (SELECT specialization_id FROM `masters` WHERE id = '.$stroka['master_id'].') and id <> '.$stroka['master_id']) or die($link);
    
    echo "<tr id='record" . $stroka['id'] . "'>";
    echo "<td > {$stroka['Клиент']} </td>";
    echo "<td > {$stroka['Телефон клиента']} </td>";
    echo "<td class='master' >".$stroka['Мастер']."</td>";
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
        echo "<td align=center><a class='re-record' onclick='recordEdit(".$stroka['id'].")'>Перенести</a></td>";
    echo "</tr>";
}
mysqli_close($link);

?>
<script>
 

</script>