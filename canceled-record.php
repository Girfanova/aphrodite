<?php
	require_once("connect_db.php");
	mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
    $zapros="UPDATE records SET canceled=1 Where id=".$_GET['id'];
    mysqli_query($link,$zapros);
	$master_id_zapros = mysqli_fetch_array(mysqli_query($link,"SELECT id FROM users WHERE concat(name,' ', surname)='".$_GET['master']."' and role_id=2"));
	$master_id=$master_id_zapros["id"];
    $zapros="UPDATE schedule SET is_busy=0 Where master_id='$master_id' and date_schedule='".$_GET['date']."' and time_schedule='".$_GET['time']."'";
    mysqli_query($link,$zapros);
	
	header('Location: lk.php');
?>