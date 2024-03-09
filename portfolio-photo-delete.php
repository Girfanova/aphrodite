<?php
 require_once("connect_db.php");
 mysqli_query($link,"DELETE FROM portfolio WHERE name= '". $_GET['name_image']."'") or die(mysqli_error($link));

 unlink('Resources/portfolio/'.$_GET['name_image']);
//  echo "<script>
            
//  document.location.href = 'admin-panel.php';
//  </script>";
