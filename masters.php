<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афродита</title>
    <link rel="stylesheet" href="style-header-footer.css" type="text/css">
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>
    <style>
    
</style>
<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
$masters = mysqli_query($link, 'SELECT * FROM masters');
$schedule = mysqli_query($link,'SELECT * from schedule where id_master=1');
?>
<div class="masters-container">
    
    <div class="masters-list">
    <a href="lk.php"><img src='Resources\back-btn.png'></a>
        <p class="popup-edit-service_title">Мастера</p>
        <?php
        while ($row = mysqli_fetch_array($masters)) {
            echo "<div class='master'>".$row['name']." ". $row['surname']."</div><a href='edit-master.php'><img src='Resources/edit.png'></a>";
        }
        ?>
        <a href="add-master.php" class="master">Добавить мастера</a>
    </div>
        <div class="schedule-list">
        
        <?php
            echo"<form>";
            echo"<table class='schedule'>";
            echo "<tr><th>День недели</th>";
            echo "<th>Начало рабочего дня</th>";
            echo "<th>Конец рабочего дня</th></tr>";
            while ($row = mysqli_fetch_array($schedule)) {
                echo"<tr>";
                switch ($row["day_of_week"]) {
                    case "0": $day='ВС'; break;
                    case '1': $day= 'ПН'; break;
                    case '2': $day= 'ВТ'; break;
                    case '3': $day= 'СР'; break;
                    case '4': $day= 'ЧТ'; break;
                    case '5': $day= 'ПТ'; break;
                    case '6': $day= 'СБ';
                }
                echo "<td>".$day."</td>
                <td><input type=time value='".$row['start_of_work']."'></td>
                <td> <input type=time value='". $row['end_of_work']."'></td>";
                echo"</tr>";
        }
        echo"</table>";
        echo '<input type="submit" value="Сохранить" class="btn form-submit-btn">';
        echo"</form>";
        ?>
        </div>
</div>

<?php require_once("footer.php") ?>
</body>

</html>