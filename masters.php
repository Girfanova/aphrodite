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
            <select id="master-list" onchange="show_master_schedule(this);">
            <?php
            $k=0;
            while ($row = mysqli_fetch_array($masters)) {
                if ($k== 0) { $k= 1; $first_m=$row['id']; 
                    echo "<option value=".$row['id']." class='master' selected>" . $row['name'] . " " . $row['surname']."</option>";
                }
                else
                echo "<option value=".$row['id']." class='master'>" . $row['name'] . " " . $row['surname']."</option>";
                    
            }
            ?>

            </select>
            <!-- <a href="add-master.php" class="master">Добавить мастера</a>
            <a href="add-master.php" class="master">Удалить мастера</a> -->
            <a href="add-master.php" class="master">Редактировать мастера</a>
        </div>
        <div class="schedule-list">
            <form id='form-schedule' onsubmit='return false;' method='post'>
               <div id='schedule-master'></div>
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>

    <?php require_once("footer.php") ?>
    <script>
        $("document").ready(function(){
            let id = $('#master-list').val();
            console.log(id);
            $.ajax({
            url: "get-master-schedule.php",
            data: {id : id},
            success: function (html) {
                $("#schedule-master").html(html);
            }
        });
        })
        function show_master_schedule(select){
            let id = select.value;
            $.ajax({
            url: "get-master-schedule.php",
            data: {id : id},
            success: function (html) {
                $("#schedule-master").html(html);
            }
        });
        }
        $('#form-schedule').on("submit", function(){
        var dataForm = $(this).serialize();
        console.log(dataForm);
        $.ajax({
			url: 'save-edit-schedule.php',         /* Куда отправить запрос */
			method: 'post',             /* Метод запроса (post или get) */
            async: false,
			dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
			data:dataForm,     /* Данные передаваемые в массиве */
			success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
				alert(data); /* В переменной data содержится ответ от index.php. */
			}
		});
    })
    $('#start-0').on('input', function(){
        console.log('hello');
    })
    </script>
</body>

</html>