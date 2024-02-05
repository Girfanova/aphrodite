<?php

	$link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
    $zapros="UPDATE records SET done=1 Where id=".$_GET['id'];
    mysqli_query($link,$zapros);
	header('Location: lk.php');
?>