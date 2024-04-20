<?php
require_once("connect_db.php");
if (isset($_POST["id"])) {
    $portfolio_id = $_POST['id'];
    $portfolio = mysqli_query($link, 'SELECT * FROM portfolio where id=' . $portfolio_id);
    while ($row = mysqli_fetch_array($portfolio)) {
        $portfolio_description = $row['description'];
        $portfolio_picture = $row['name'];
    } 
}
echo json_encode(array('portfolio_id' => $portfolio_id, 'portfolio_picture' => $portfolio_picture,'portfolio_description' =>  $portfolio_description));

