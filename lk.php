<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>

    <style>
        
    </style>
    <div class="lk">
        <?php
        session_start();
        require_once("connect_db.php");
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        echo "<div class='lk-profile'>";
        echo "<H1 class='lk-title'>Профиль</H1>";
        while ($stroka = mysqli_fetch_array($user)) {
            echo "<div class='profile-table'>";
            echo "<div class='profile-circle'>" . mb_substr($stroka['name'], 0, 1) . "</div>";
            echo "<div>
                    <div><b> {$stroka['surname']} {$stroka['name']}</b></div>
                    <div>Телефон: {$stroka['phone']}</div>
                    <div class='lk-role'><b> {$stroka['role_name']}</b></div>
                </div>";

            echo "<div><div><a class='btn profile-btn' href='edit-profile.php'>Редактировать</a></div   ><div><a class='profile-btn btn' href='exit.php'>Выйти</a></div></div>";

            echo "</div>";
        }
        echo "</div>";
        if ($_SESSION["user_role"] == 1) {
            $records_not_done = mysqli_query($link, "select distinct
                        records.id,
                        service as Услуга, 
                        date_record as Дата,
                        time_record as Время,
                        (select concat(name, ' ',surname) from masters where id=master_id) as Мастер
                        from records, services, users
                        where records.service_id = services.id and done=0 and canceled=0
                        and records.user_id = " . $_SESSION['user_id']);
            echo "<div class='admin-menu'>
                   <p class='lk-title  label-checked' id='record-table-label'>Ожидаемые записи</p>";
                   echo "
                   <p class='lk-title' id='done-table-label'>Выполненные услуги</p>";
                   echo "
                   <p class='lk-title' id='canceled-table-label'>Отмененные записи</p>";
            echo "<table class='record-table table-visible' id='record-table'>";
            echo "<tr >
                   <th>Услуга</th>
                   <th>Мастер</th>
                   <th>Дата</th>
                   <th>Время</th>
                   <th>Отменить</th>
                   </tr>";
            while ($stroka = mysqli_fetch_array($records_not_done)) {
                echo "<tr>";
                echo "<td width=33%> {$stroka['Услуга']} </td>";
                echo "<td width=20%> {$stroka['Мастер']} </td>";
                echo "<td width=20%>" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
                echo "<td width=20%> " . date('H.i', strtotime($stroka['Время'])) . "</td>";
                echo "<td width=20% align='center'><a href='canceled-record.php?id=" . $stroka['id'] . "&date=" . $stroka['Дата'] . "&time=" . $stroka['Время'] . "&master=" . $stroka['Мастер'] . "'><img src='Resources/canceled.png'></img></a></td>";
                echo "</tr>";
                $t = 1;
            }
            if (mysqli_num_rows($records_not_done) <= 0)
                echo "<tr><td colspan=5>Еще нет записей</td></tr>";
            echo '</table>
                           ';
            $records_done = mysqli_query($link, "select distinct
                        service as Услуга, 
                        date_record as Дата,
                        time_record as Время,
                        (select concat(name, ' ',surname) from masters where id=master_id) as Мастер
                        from records, services, users
                        where records.service_id = services.id and done=1
                        and records.user_id = " . $_SESSION['user_id']);
            
            echo "<table class='record-table' id='done-table'>";
            echo "<tr>
                   <th width=60%>Услуга</th>
                   <th width=20%>Мастер</th>
                   <th width=20%>Дата</th>
                   <th width=30%>Время</th>
                   </tr>";
            while ($stroka = mysqli_fetch_array($records_done)) {
                echo "<tr>";
                echo "<td > {$stroka['Услуга']} </td>";
                echo "<td > {$stroka['Мастер']} </td>";
                echo "<td >" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
                echo "<td > " . date('H.i', strtotime($stroka['Время'])) . "</td>";
                echo "</tr>";
            }
            if (mysqli_num_rows($records_done) <= 0)
                echo "<tr><td colspan=5>Еще нет записей</td></tr>";
            echo '</table>
                          ';
            $records_canceled = mysqli_query($link, "select distinct
                        service as Услуга, 
                        date_record as Дата,
                        time_record as Время,
                        (select concat(name, ' ',surname) from masters where id=master_id) as Мастер
                        from records, services, users
                        where records.service_id = services.id and canceled=1
                        and records.user_id = " . $_SESSION['user_id']);
            
            echo "<table class='record-table' id='canceled-table'>";
            echo "<tr>
                   <th>Услуга</th>
                   <th>Мастер</th>
                   <th>Дата</th>
                   <th>Время</th>
                   </tr>";
            while ($stroka = mysqli_fetch_array($records_canceled)) {
                echo "<tr>";
                echo "<td width=65%> {$stroka['Услуга']} </td>";
                echo "<td width=20%> {$stroka['Мастер']} </td>";
                echo "<td width=11%>" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
                echo "<td width=9%> " . date('H.i', strtotime($stroka['Время'])) . "</td>";
                echo "</tr>";
            }
            if (mysqli_num_rows($records_canceled) <= 0)
                echo "<tr><td colspan=5>Еще нет записей</td></tr>";
            echo '</table>
                            </div>';
        }
        elseif ($_SESSION['user_role']==3) {
            echo '<a href="records-list.php" class="functional-button"><img src="Resources/record.png">Учет посещений</a>
            <a width=100% class="functional-button" href="masters.php"><img src="Resources/master.png">Мастера</a>
            </div>
            ';
        }
        ?>
    </div>


    <?php require_once("footer.php") ?>
</body>

</html>