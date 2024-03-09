<?php
require_once("connect_db.php");
 mysqli_query($link,"DELETE FROM services WHERE id= '". $_GET['service_id']."'") or die(mysqli_error($link));
//  echo "<script>
            
//  document.location.href = 'admin-panel.php';
//  </script>";
