<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname= "aphrodite";

  $link = mysqli_connect($servername, $username, $password, $dbname);

  if (!$link) {
   die("Ошибка соединения: " . mysqli_connect_error(). "Код ошибки:" .  mysqli_connect_errno());
 }