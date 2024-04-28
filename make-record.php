<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/style-pages.css" type="text/css">
</head>

<body>
    <?php require_once ("header.php") ?>
    <div class="record-container">
        <a href='#' onclick='history.back(); return false;'>
        <img src='Resources/back-btn.svg' class='back-btn' title='Назад'>
    </a>
        <p class='record-title'>Запись на услугу</p>
        <?php
        session_start();
        require_once ("connect_db.php");
        $user = mysqli_query($link, "SELECT users.id, surname, name,  phone FROM users  WHERE users.id = " . $_SESSION["user_id"]);
        while ($stroka = mysqli_fetch_array($user)) {
            $id = $_GET["id"];
            $name = $stroka["name"];
            $surname = $stroka["surname"];
            $phone = $stroka["phone"];
        }
        $selected_service = mysqli_query($link, "SELECT service, duration_in_min FROM services  WHERE services.id =" . $_GET['id']);
        while ($stroka = mysqli_fetch_array($selected_service)) {
            $id = $_GET["id"];
            $service = $stroka["service"];
            $master = $stroka["surname"] . ' ' . $stroka["name"];
            $master_id = $stroka["master_id"];
            $duration = $stroka["duration_in_min"];
        }
        mysqli_close($link);
        ?>

        <form class='form-make-record' id='form-make-record' onsubmit='return false;' method="post">

            <div class="label">Записывается</div>
            <div class="input-box">
                <div class="input" name='name'>
                    <?php echo "$surname $name"; ?>
                </div>
            </div>
            <div class="label">Услуга</div>
            <div class="input-box">
                <div class="input" name='service'>
                    <?php echo $service; ?>
                </div>
            </div>
            <!-- <div class="label" name="master">Мастер</div>
                <div class="input-box">
                    <div class="input"><b>
                            <?php echo $master; ?>
                        </b></div>
                </div> -->
            <div class="label">Дата</div>
            <div class="input-box">
                <input id='date-record' name="date-record" type="date"
                    oninput='getdate(this.value, <? echo $_GET["id"] ?>);'
                    min="<?php echo date('Y-m-d', strtotime("+1 days")); ?>"
                    max="<?php echo date('Y-m-d', strtotime("+7 days")); ?>" class="input" required>
            </div>
            <div class="label">Время</div>
            <div class="input-box">
                <div>
                    <select class='input' name="record-time" id="record-times" required
                        style='width: calc(100% - 24px);'>
                        <option>Выберите дату</option>
                    </select>
                    <div style=' display: inline-block; margin:0 0 0 1%; position:relative;'>
                        <img style=' position: absolute;
    margin-top: -17px;
    margin-left: -1px; width:20px;' src='Resources\time.svg'>
                    </div>
                </div>
            </div>

            <input name="master_id" id="master_id" hidden><br>
            <input name="service_id" hidden value=<?php echo $_GET['id']; ?>><br>

            <input type="submit" value="Записаться" class="btn form-submit-btn">
        </form>

    </div>

    <?php require_once ("footer.html") ?>
    <script>

        function getdate(e, id) {
            let date1 = new Date(e);
            let day_of_week = date1.getDay();
            let date = date1.toISOString().split('T')[0];
            console.log(day_of_week);
            $.ajax({
                method: 'POST',
                url: "get-free-records.php",
                async: false,
                data: { day_of_week: day_of_week, date: date, service_id: id },
                success: function (html) {
                    $('#record-times').html(html);
                }
            });
        };

    </script>

</body>

</html>