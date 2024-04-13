<?php 
    require_once('connect_db.php');
    $query = "UPDATE reviews set content='".$_POST['review_content']."', name='".$_POST['review_author']."', date='".$_POST['review_date']."' where id=". $_POST['review_id'];
    mysqli_query($link, $query) or die("Ошибка");
    mysqli_close($link);
    echo "Данные обновлены";
