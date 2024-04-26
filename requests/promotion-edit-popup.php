<?php
require_once("connect_db.php");
if (isset($_POST["promotion_id"])) {
    $promotion_id = $_POST['promotion_id'];
    $promotions = mysqli_query($link, 'SELECT * FROM promotions where id=' . $promotion_id);
    while ($row = mysqli_fetch_array($promotions)) {
        $promotion_title = $row['title'];
        $promotion_description = $row['description'];
        $promotion_picture = $row['picture'];
    }
}
echo json_encode(array('id' => $promotion_id, 'picture' => $promotion_picture,'description' =>  $promotion_description, 'title' => $promotion_title));