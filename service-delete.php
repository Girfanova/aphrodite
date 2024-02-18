<?php
 $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
 mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
 mysqli_query($link,"DELETE FROM services WHERE id= '". $_GET['service_id']."'") or die(mysqli_error($link));
 echo "<script>
            
 document.location.href = 'admin-panel.php';
 </script>";
