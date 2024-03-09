<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname= "aphrodite";

  // Create connection
  $link = mysqli_connect($servername, $username, $password, $dbname);
  //mysqli_set_charset ( $conn , "utf8");

  // Check connection
  if (!$link) {
   die("Connection failed: " . mysqli_connect_error());
 }