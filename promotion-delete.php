<?php
require_once("connect_db.php");
$query = mysqli_query($link, "SELECT * from promotions where id=".$_GET['promotion_id']) or die(mysqli_error($link));
$row = mysqli_fetch_array($query);
if ($row['picture']) {
    unlink('Resources/promotions/'.$row['picture']);
}
mysqli_query($link, "DELETE FROM promotions WHERE id= '" . $_GET['promotion_id'] . "'") or die(mysqli_error($link));
mysqli_close($link);
