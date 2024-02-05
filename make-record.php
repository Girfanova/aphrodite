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
            .record{
                padding:5%;
                font-size:1.5em;
            }
            .record-title{
                font-size:2em;
                padding:2%;
            }
            .form-make-record{
                display:flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: baseline;
                border-radius:10px;
                border: 1px solid grey;
                padding:2%;
            }
            .button{
                background-color:#E7CCDE;
                padding:1%;
                font-size:1.1em;
                border:1px solid grey;
            }
            select{
                display: inline;
                width:89%;
            }
        </style>
        <div class="record" >
            <div class=''>      
                <p class='record-title'>Запись на услугу</p>
            <?php 
                session_start();
                $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
                $user = mysqli_query($link,"SELECT users.id, surname, name,  phone FROM users  WHERE users.id = " . $_SESSION["user_id"]);
                while ($stroka = mysqli_fetch_array($user)) {
                    $id = $_GET["id"];
                    $name= $stroka["name"];
                    $surname= $stroka["surname"];
                    $phone= $stroka["phone"];
                }
                $selected_service = mysqli_query($link,"SELECT master_id_service, service, name, surname FROM services, users  WHERE services.id =".$_GET['id']." and master_id_service=users.id");
                while ($stroka = mysqli_fetch_array($selected_service)) {
                    $id = $_GET["id"];
                    $service= $stroka["service"];
                    $master = $stroka["surname"] . ' ' . $stroka["name"];
                    $master_id = $stroka["master_id_service"];
                }
                
                   
                         
                            
                ?>
                
                <form class='form-make-record' onsubmit='return checkTypeTime();' action="save-new-record.php" method="post">
                    
                        <div class="label">Записывается</div>
                        <div class="input-box">
                            <div class="input" name='name'><b><?php echo "$surname $name";?></b></div>
                        </div>
                        <div class="label">Услуга</div>
                        <div class="input-box">
                            <div class="input" name='service'><b><?php echo $service;?></b></div>
                        </div>
                        <div class="label" name="master">Мастер</div><div class="input-box">
                            <div class="input"><b><?php echo $master;?></b></div>
                        </div>
                        <div class="label">Дата</div><div class="input-box">
                            <input id='date-record' name="date-record" type="date" oninput='getdate(this.value);' min="<?php echo date('Y-m-d',strtotime("+1 days"));?>" max="<?php echo date('Y-m-d',strtotime("+14 days"));?>" class="input" required><br>
                        </div>
                        <div class="label">Время</div><div class="input-box">
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
                           
                            <input name="master_id" hidden value=<?php echo $master_id;?>><br>
                            <input name="service_id" hidden value=<?php echo $_GET['id'];?>><br>
                    
	                    <input type="submit" value="Записаться" class="btn form-submit-btn">
	            </form>
            </div>
            </div>

            <?php   
?>
        
        <?php require_once("footer.php")?>
        <script>
        <?php 
             $today = date('Y-m-d');
             $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
             mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
             $time_for_this_date = mysqli_query($link,"SELECT date_schedule, time_schedule, is_busy FROM schedule where master_id='$master_id' and date_schedule BETWEEN '".date('Y-m-d',strtotime("+1 days"))."' and '".date('Y-m-d',strtotime('+14 days'))."'");
            
             while ($stroka = mysqli_fetch_array($time_for_this_date)) {
                 $datetimes[] = [$stroka['date_schedule'], $stroka['time_schedule'], $stroka['is_busy']];
             }
             
             for ($i=0; $i<14; $i++){
                 $date = date('Y-m-d',strtotime("+$i days"));
                 foreach ($datetimes as $dt){
                     if (($dt[0] == $date) && (($dt[2] == false))) {
                         $d[$i][] = $dt[1];
                     }
                     }
                 }
                 echo "var d = ". json_encode($d) . ";\n";
                // for ($i=0; $i<12; $i++){
                //      if (isset($d[$i]))
                //      echo "var d = ". json_encode($d) . ";\n";
                //  }
        ?> 
        var selectBox = document.getElementById('record-times');
        function getdate(selectdate){
            let date1 = new Date(selectdate);
            let date2 = new Date();
            let r=Math.ceil((date1-date2)/(60 * 60 * 24 * 1000));
            console.log(r);
            selectBox.options.length=0;
            if (d[r]){
            d[r].forEach(time => {
            selectBox.add(new Option(time.substr(0,5)))
           });} 
           else selectBox.add(new Option('Нет записи'));
        }
                 
        </script>
         <script src="script.js"></script>
    </body>
</html>