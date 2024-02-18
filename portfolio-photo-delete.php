<?php
 $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
 mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
 mysqli_query($link,"DELETE FROM portfolio WHERE name= '". $_GET['name_image']."'") or die(mysqli_error($link));

 unlink('Resources/portfolio/'.$_GET['name_image']);
