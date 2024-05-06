<?php session_start();
if (!isset($_SESSION['auth']))
    header('Location:/');
if (($_SESSION['user_role']) == 10)
    header('Location:admin.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/lk.css" type="text/css">
    <link rel="stylesheet" href="css/style-pages.css" type="text/css">
</head>

<body>
    <?php require_once ("header.php")
        ?>
    <div class="lk">
        <?php

        require("connect_db.php");
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

            echo "<div><div><a class='btn profile-btn ' href='edit-profile.php'>Редактировать</a></div><div><a class='profile-btn btn' href='requests/exit.php'>Выйти</a></div></div>";

            echo "</div>";
        }
        mysqli_close($link);
        echo "</div>";
        if ($_SESSION["user_role"] == 1) {
            require("connect_db.php");
            $records_not_done = mysqli_query($link, "select distinct
                        records.id,
                        service as Услуга, 
                        date_record as Дата,
                        time_record as Время,
                        (select concat(name, ' ',surname) from masters where id=master_id) as Мастер,
                        done, canceled
                        from records, services, users
                        where records.service_id = services.id 
                        and records.user_id = " . $_SESSION['user_id'] ."
                        order by date_record desc"
                        
                    );
                       
                    echo " <div class='tab-nav'>
                    <button type='button' class='tab-btn tab-btn-active' data-target-id='0'>Мои записи</button>                
                    </div>
                    ";
            echo "<div class='admin-menu'>
            <table class='record-table table-visible' id='record-table'>";
            echo "<tr >
                    <th width=22%>Услуга</th>
                   <th width=14%>Мастер</th>
                   <th width=10%>Дата</th>
                   <th width=7%>Время</th>
                   <th width=9%>Отменить</th>
                   <th width=9%>Статус</th>
                   </tr>";
                $today = date('Y-m-d');
            while ($stroka = mysqli_fetch_array($records_not_done)) {
                echo "<tr id='record".$stroka['id']."'>";
                echo "<td> {$stroka['Услуга']} </td>";
                echo "<td> {$stroka['Мастер']} </td>";
                echo "<td>" . date('d.m.Y', strtotime($stroka['Дата'])) . " </td>";
                echo "<td> " . date('H.i', strtotime($stroka['Время'])) . "</td>";
                if ($stroka['canceled'] == 1) {
                    if ($stroka['Дата']<$today) echo "<td  align='center' class='canceled-btn'>&mdash;</td>";
                    else echo "<td  align='center' class='canceled-btn'><input type='checkbox' checked onclick='removeCanceledRecord(" . $stroka['id'] . ");'></td>";
                }

                else if ($stroka['done'] == 1) echo "<td align='center'>&mdash;</td>";                
                else echo "<td  align='center' class='canceled-btn'><input type='checkbox' onclick='makeCanceledRecord(" . $stroka['id'] . ");'></td>";
                
                if ($stroka['done'] == 1) echo "<td class='status'>Выполнено</td>";
                else if ($stroka['canceled'] == 1) echo "<td class='status'>Отменено</td>";
                else echo "<td class='status'>В ожидании</td>";
                echo "</tr>";
                $t = 1;
            }
            if (mysqli_num_rows($records_not_done) <= 0)
                echo "<tr><td colspan=6>Записей на ближайшее время нет</td></tr>";
            echo '</table>
            </div>';
            mysqli_close($link);
        } elseif ($_SESSION['user_role'] == 2) {
            echo '
            <div class="tab" id="tab-1">
                <div class="tab-nav">
                    <button type="button" class="tab-btn tab-btn-active" data-target-id="0">Записи</button>
                    <button type="button" class="tab-btn" data-target-id="1">Мой график</button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane tab-pane-show" data-id="0">';
                    require('records-master-list.php');
                    echo '</div>
                    <div class="tab-pane" data-id="1">';
                    
                    require('my-graph.php');
                    echo'</div>
                </div>
            </div>
            ';
        }
        elseif ($_SESSION['user_role'] == 3) {
            echo '
            <div class="tab" id="tab-1">
                <div class="tab-nav">
                    <button type="button" class="tab-btn tab-btn-active" data-target-id="0" id="rec-btn">Учет посещений</button>
                    <button type="button" class="tab-btn" data-target-id="1">Мастера</button>
                    <button type="button" class="tab-btn" data-target-id="2" id="graph-btn">График</button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane tab-pane-show" data-id="0">';
                    require('records-list.php');
                    echo '</div>

                    <div class="tab-pane" data-id="1">';
                    require('masters.php');
                    echo'</div>
                    
                    <div class="tab-pane" data-id="2" id="graph-container">';
                    // require('graph.php');
                    echo'</div>
                </div>
            </div>
            ';
        }
        ?>
    </div>


    <?php require_once ("footer.html") ?>
    <script language="JavaScript" type="text/javascript" src="js/lk.js"></script>
    
</body>

</html>