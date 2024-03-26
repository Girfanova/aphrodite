<?php
require_once ("connect_db.php");
$name = mysqli_fetch_row(mysqli_query($link,'SELECT name from portfolio where id='.$_GET['id_image']));
mysqli_query($link, "DELETE FROM portfolio WHERE id= '" . $_GET['id_image'] . "'") or die (mysqli_error($link));
unlink('Resources/portfolio/' . $name[0]);

//  echo "<script>

//  document.location.href = 'admin-panel.php'; 
//  </script>";
