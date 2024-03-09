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
        .record {
            padding: 5%;
            font-size: 1.5em;
        }

        .record-title {
            font-size: 2em;
            padding: 2%;
        }

        .form-make-record {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: baseline;
            border-radius: 10px;
            border: 1px solid grey;
            padding: 2%;
        }

        .button {
            background-color: #E7CCDE;
            padding: 1%;
            font-size: 1.1em;
            border: 1px solid grey;
        }

        select {
            display: inline;
            width: 89%;
        }
    </style>
    <div class="record">
        <div class=''>
            <a href=''><img src='Resources/back-btn.png'></a>
            <p class='record-title'>Запись на услугу</p>
            <?php
            session_start();
            require_once("connect_db.php");
           // mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
            $user = mysqli_query($link, "SELECT users.id, surname, name,  phone FROM users  WHERE users.id = " . $_SESSION["user_id"]);
            while ($stroka = mysqli_fetch_array($user)) {
                $id = $_GET["id"];
                $name = $stroka["name"];
                $surname = $stroka["surname"];
                $phone = $stroka["phone"];
            }
            $selected_service = mysqli_query($link, "SELECT service, name, surname, duration_in_min, master_id FROM services, masters, categories  WHERE services.id =" . $_GET['id'] . " and masters.id=master_id and category_id=categories.id");
            while ($stroka = mysqli_fetch_array($selected_service)) {
                $id = $_GET["id"];
                $service = $stroka["service"];
                $master = $stroka["surname"] . ' ' . $stroka["name"];
                $master_id = $stroka["master_id"];
                $duration = $stroka["duration_in_min"];
            }
            $selected_master_schedule = mysqli_query($link, "SELECT * FROM schedule WHERE id_master =" . $master_id);
            $schedule = [];
            while ($stroka = mysqli_fetch_array($selected_master_schedule)) {
                $schedule[] = [$stroka['day_of_week'], $stroka["start_of_work"], $stroka["end_of_work"]];
            }
            // print_r($schedule);
            ?>

            <form class='form-make-record' onsubmit='return checkTypeTime();' action="save-new-record.php"
                method="post">

                <div class="label">Записывается</div>
                <div class="input-box">
                    <div class="input" name='name'><b>
                            <?php echo "$surname $name"; ?>
                        </b></div>
                </div>
                <div class="label">Услуга</div>
                <div class="input-box">
                    <div class="input" name='service'><b>
                            <?php echo $service; ?>
                        </b></div>
                </div>
                <div class="label" name="master">Мастер</div>
                <div class="input-box">
                    <div class="input"><b>
                            <?php echo $master; ?>
                        </b></div>
                </div>
                <div class="label">Дата</div>
                <div class="input-box">
                    <input id='date-record' name="date-record" type="date" oninput='getdate(this.value);'
                        min="<?php echo date('Y-m-d', strtotime("+1 days")); ?>"
                        max="<?php echo date('Y-m-d', strtotime("+7 days")); ?>" class="input" required><br>
                </div>
                <div class="label">Время</div>
                <div class="input-box">
                    <div>
                        <select class='input' name="record-time" id="record-times" cfm_check="Y" required>
                            <option>Выберите дату</option>
                        </select>
                        <div style=' display: inline-block; margin:0 0 0 1%; position:relative;'>
                            <img style=' position: absolute;
    top: 50%;
    margin-top: -20px;
    left: 50%;
    margin-left: -20px;' src='Resources\time.png'>
                        </div>
                    </div>
                </div>

                <input name="master_id" hidden value=<?php echo $master_id; ?>><br>
                <input name="service_id" hidden value=<?php echo $_GET['id']; ?>><br>

                <input type="submit" value="Записаться" class="btn form-submit-btn">
            </form>
        </div>
    </div>

    <?php require_once("footer.php") ?>
    <script>
        <?php
        $today = date('Y-m-d');
        require_once("connect_db.php");
        //$time_for_this_date = mysqli_query($link, "SELECT date_schedule, time_schedule, is_busy FROM schedule where master_id='$master_id' and date_schedule BETWEEN '" . date('Y-m-d', strtotime("+1 days")) . "' and '" . date('Y-m-d', strtotime('+14 days')) . "'");
        
        // while ($stroka = mysqli_fetch_array($time_for_this_date)) {
        //     $datetimes[] = [$stroka['date_schedule'], $stroka['time_schedule'], $stroka['is_busy']];
        // }
        
        // for ($i = 0; $i < 14; $i++) {
        //     $date = date('Y-m-d', strtotime("+$i days"));
        //     foreach ($datetimes as $dt) {
        //         if (($dt[0] == $date) && (($dt[2] == false))) {
        //             $d[$i][] = $dt[1];
        //         }
        //     }
        // }
        echo "var schedule = " . json_encode($schedule) . ";\n";
        // for ($i=0; $i<12; $i++){
        //      if (isset($d[$i]))
        //      echo "var d = ". json_encode($d) . ";\n";
        //  }
        
        ?>
        var selectBox = document.getElementById('record-times');
        function getdate(e) {
            // e.preventDefault();
            // $.ajax({
            //     type: "POST",
            //     url: 'datetime.php',
            //     data: $(this).serialize(),
            //     success: function (response) {
            //         var jsonData = JSON.parse(response);
            //          record-times.            

            //     }
            // });

            let date1 = new Date(e);

            let day_of_week = date1.getDay();
            selectBox.options.length = 0;
            var start;
            var end;
            schedule.forEach(arr => {
                if (arr[0] == day_of_week) {
                    start = arr[1];
                    end = arr[2];
                }
            });
            let date_start = new Date(Date.parse('2012-01-26T' + start));
            let date_end = new Date(Date.parse('2012-01-26T' + end));
            while (date_end.getTime()!==date_start.getTime()) {
                Hour = date_start.getHours();
                Minutes = date_start.getMinutes();
                selectBox.add(new Option(Hour+':'+Minutes+"0"));
                date_start.setHours(date_start.getHours() + 1);
            }
            // alert (date_start);
            // alert (date_end);
            // alert (date_end.getTime()!==date_start.getTime());



            // if (schedule[][]) {
            //     d[r].forEach(time => {
            //         selectBox.add(new Option(time.substr(0, 5)))
            //     });
            // }
            // else selectBox.add(new Option('Нет записи'));
        }
        // var selectBox = document.getElementById('record-times');
        // function getdate(selectdate) {
        //     let date1 = new Date(selectdate);
        //     let date2 = new Date();
        //     let r = Math.ceil((date1 - date2) / (60 * 60 * 24 * 1000));
        //     console.log(r);
        //     selectBox.options.length = 0;
        //     if (d[r]) {
        //         d[r].forEach(time => {
        //             selectBox.add(new Option(time.substr(0, 5)))
        //         });
        //     }
        //     else selectBox.add(new Option('Нет записи'));
        // }

    </script>

</body>

</html>