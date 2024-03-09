<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>
    <style>

    </style>
    <?php
    require_once("connect_db.php");
    $masters = mysqli_query($link, 'SELECT * FROM masters');
    ?>
    <div class="masters-container">

        <div class="masters-list">
            <a href="lk.php"><img src='Resources\back-btn.png'></a>
            <p class="popup-edit-service_title">Мастера</p>
            <?php
            while ($row = mysqli_fetch_array($masters)) {
                echo "<div onclick=show_master_schedule(".$row['id']."); class='master'>" . $row['name'] . " " . $row['surname'] .
                    "</div><img src='Resources/edit.png'>" .
                    "<img src='Resources/delete.png'>";
            }
            ?>
            <a href="add-master.php" class="master">Добавить мастера</a>
        </div>
        <div class="schedule-list">
            <form>
                <table class='schedule'>
                    <tr>
                        <th>День недели</th>
                        <th>Начало рабочего дня</th>
                        <th>Конец рабочего дня</th>
                    </tr>
                    <tbody id='schedule-master'>
                    </tbody>
                   <?require_once('get-master-schedule.php')?>
                </table>
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>

    <?php require_once("footer.php") ?>
    <script>
        function show_master_schedule(){
            //здесь будет аякс
        }
    </script>
</body>

</html>