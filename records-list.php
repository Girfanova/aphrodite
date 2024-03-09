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
        echo "<a href='lk.php'><img src='Resources\back-btn.png'></a><H1 class='lk-title'>Учет посещений</H1>";

        echo "</div>";
        if ($_SESSION["user_role"] == 3) {

            $records = mysqli_query($link, "Select distinct
                    (select phone from users where users.role_id=1 and users.id=user_id) as 'Телефон клиента', 
                    (select concat(name, ' ', surname) from users where users.role_id=1 and users.id=user_id) as Клиент, 
                    (select concat(name, ' ',surname) from masters where masters.id=master_id) as Мастер,  
                    service as Услуга, 
                    date_record as Дата,
                    time_record as Время,
                    records.id,
                    done,
                    canceled
                    from users, roles, records, services
                    where services.id = service_id 
                    order by date_record ");
            echo "<div class='admin-menu'>";
            echo "<table class='record-table table-visible' id='record-table'>";
            echo "<tr>
                   <th width=10%>Клиент</th>
                   <th width=15%>Телефон клиента</th>
                   <th width=14%>Мастер</th>
                   <th width=22%>Услуга</th>
                   <th width=10%>Дата</th>
                   <th width=7%>Время</th>
                   <th width=9%>Отменить</th>
                   <th width=9%>Выполнено</th>
                   </tr>";
            while ($stroka = mysqli_fetch_array($records)) {
                echo "<tr>";
                echo "<td > {$stroka['Клиент']} </td>";
                echo "<td > {$stroka['Телефон клиента']} </td>";
                echo "<td > {$stroka['Мастер']} </td>";
                echo "<td > {$stroka['Услуга']} </td>";
                echo "<td >" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
                echo "<td > " . date('H.i', strtotime($stroka['Время'])) . "</td>";
                if ($stroka['canceled']== 0 && $stroka['done']== 0) echo "<td  align='center'><a href='canceled-record.php?id=" . $stroka['id'] . "&date=" . $stroka['Дата'] . "&time=" . $stroka['Время'] . "&master=" . $stroka['Мастер'] . "'><img src='Resources/canceled.png'></img></a></td>";
                elseif ($stroka['canceled']== 1) echo '<td>Отменено</td>';
                else echo'<td>-</td>';
                if ($stroka['done']== 0 && $stroka['canceled']== 0) echo "<td  align='center'><a href='done-record.php?id=" . $stroka['id'] . "'><img src='Resources/done.png'></img></a></td>";
                elseif ($stroka['done']== 1) echo '<td>Выполнено</td>';
                else echo'<td>-</td>';
                echo "</tr>";
            }
            if (empty($records))
                echo "<tr><td colspan=8>Еще нет записей</td></tr>";
            echo '</table>
                            ';

            echo '</div>';
        }
        ?>
    </div>


    <?php require_once("footer.php") ?>
</body>

</html>