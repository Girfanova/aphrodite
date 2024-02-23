<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
$query = mysqli_query($link, "SELECT * from promotions where id=".$_GET['promotion_id']) or die(mysqli_error($link));
$row = mysqli_fetch_array($query);
if ($row['picture']) {
    unlink('Resources/promotions/'.$row['picture']);
}
mysqli_query($link, "DELETE FROM promotions WHERE id= '" . $_GET['promotion_id'] . "'") or die(mysqli_error($link));
echo "<script>
            
 document.location.href = 'admin-panel.php';
 </script>";
