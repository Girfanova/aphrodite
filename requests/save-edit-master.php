<?php 
if (isset ($_POST['id']) and isset($_POST['selected_cat'])){
    $id=$_POST['id'];
    $cat = $_POST['selected_cat'];
    $query = 'UPDATE masters set specialization_id='.$cat.' where id='.$id;
    require_once('connect_db.php');
    mysqli_query($link, $query) or die($link);
    mysqli_close($link);
}