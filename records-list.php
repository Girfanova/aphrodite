<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Афродита</title>
        <link rel="stylesheet" href="style-header-footer.css" type="text/css">
        <link rel="stylesheet" href="style-pages.css" type="text/css">
    </head>
    <body>
    <?php require_once("header.php")?>
    <?php require_once("auth.php")?>
        
        <style>
           
        </style>
        <div class="lk">
            <?php 
                session_start();
                $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
                $user = mysqli_query($link,"SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"]." and role_id=roles.id");
                echo "<div class='lk-profile'>";        
                echo "<a href='lk.php'><img src='Resources\back-btn.png'></a><H1 class='lk-title'>Учет посещений</H1>";
                
                echo "</div>";
                if ($_SESSION["user_role"]==10){
                    
                    $records_not_done = mysqli_query($link,"Select distinct
                    (select phone from users where users.role_id=1 and users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.role_id=1 and users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from users where users.role_id=2 and users.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id and done=0 and canceled=0
                    order by date_record ");
                   echo "<div class='admin-menu'>
                   <p class='lk-title label-checked' id='record-table-label'>Записи клиентов</p>";
                   echo "
                   <p class='lk-title' id='done-table-label'>Выполненные услуги</p>";
                   echo "
                   <p class='lk-title' id='canceled-table-label'>Отмененные записи</p>";
                   echo "<table class='record-table table-visible' id='record-table'>";
                   echo "<tr>
                   <th>Клиент</th>
                   <th>Телефон клиента</th>
                   <th>Мастер</th>
                   <th>Услуга</th>
                   <th>Дата</th>
                   <th>Время</th>
                   <th>Отменить</th>
                   <th>Выполнена</th>
                   </tr>";
                    while ($stroka = mysqli_fetch_array($records_not_done)) {
                    echo "<tr>";
                    echo "<td width=10%> {$stroka['Клиент']} </td>";
                    echo "<td width=15%> {$stroka['Телефон клиента']} </td>";
                    echo "<td width=14%> {$stroka['Мастер']} </td>";
                    echo "<td width=22%> {$stroka['Услуга']} </td>";
                    echo "<td width=10%>" . date('d.m.Y', strtotime($stroka['Дата'])). " </td>";
                    echo "<td width=7%> " . date('H.i', strtotime($stroka['Время'])). "</td>";
                    echo "<td width=9% align='center'><a href='canceled-record.php?id=".$stroka['id']."&date=".$stroka['Дата']."&time=".$stroka['Время']."&master=".$stroka['Мастер']."'><img src='Resources/canceled.png'></img></a></td>";
                    echo "<td width=9% align='center'><a href='done-record.php?id=".$stroka['id']."'><img src='Resources/done.png'></img></a></td>";
                    echo "</tr>";
                    }
                    if (empty($records_not_done)) echo "<tr><td colspan=8>Еще нет записей</td></tr>";
                    echo '</table>
                            ';
                    
                    $records_done = mysqli_query($link,"Select distinct
                    (select phone from users where users.role_id=1 and users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.role_id=1 and users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from users where users.role_id=2 and users.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id and done=1
                    order by date_record ");
                  
                   echo "<table class='record-table' id='done-table'>";
                   echo "<tr>
                   <th>Клиент</th>
                   <th>Телефон клиента</th>
                   <th>Мастер</th>
                   <th>Услуга</th>
                   <th>Дата</th>
                   <th>Время</th>
                   </tr>";
                    while ($stroka = mysqli_fetch_array($records_done)) {
                    echo "<tr>";
                    echo "<td width=10%> {$stroka['Клиент']} </td>";
                    echo "<td width=15%> {$stroka['Телефон клиента']} </td>";
                    echo "<td width=14%> {$stroka['Мастер']} </td>";
                    echo "<td width=22%> {$stroka['Услуга']} </td>";
                    echo "<td width=10%>" . date('d.m.Y', strtotime($stroka['Дата'])). " </td>";
                    echo "<td width=7%> " . date('H.i', strtotime($stroka['Время'])). "</td>";
                    echo "</tr>";
                    }
                    if (mysqli_num_rows($records_done)<=0) echo "<tr><td colspan=6>Еще нет записей</td></tr>";
                    echo '</table>
                            ';
                    $records_canceled = mysqli_query($link,"Select distinct
                    (select phone from users where users.role_id=1 and users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.role_id=1 and users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from users where users.role_id=2 and users.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id and canceled=1
                    order by date_record ");
                   
                   echo "<table class='record-table' id='canceled-table'>";
                   echo "<tr>
                   <th>Клиент</th>
                   <th>Телефон клиента</th>
                   <th>Мастер</th>
                   <th>Услуга</th>
                   <th>Дата</th>
                   <th>Время</th>
                   </tr>";
                    while ($stroka = mysqli_fetch_array($records_canceled)) {
                    echo "<tr>";
                    echo "<td width=10%> {$stroka['Клиент']} </td>";
                    echo "<td width=15%> {$stroka['Телефон клиента']} </td>";
                    echo "<td width=14%> {$stroka['Мастер']} </td>";
                    echo "<td width=22%> {$stroka['Услуга']} </td>";
                    echo "<td width=10%>" . date('d.m.Y', strtotime($stroka['Дата'])). " </td>";
                    echo "<td width=7%> " . date('H.i', strtotime($stroka['Время'])). "</td>";
                    echo "</tr>";
                    }
                    if (mysqli_num_rows($records_canceled)<=0) echo "<tr><td colspan=5>Еще нет записей</td></tr>";
                    echo '</table>
                            </div>';
                    }
                    ?>
                    </div>
        
        
        <?php require_once("footer.php")?>
    </body>
</html>