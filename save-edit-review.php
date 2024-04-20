<?php 
    require_once('connect_db.php');
    if (isset($_POST['review_content']) & isset($_POST['review_author']) & isset($_POST['review_date']) & isset($_POST['review_id']) ){
        $content = addslashes($_POST['review_content']);
        $author = addslashes($_POST['review_author']);
        $date = $_POST['review_date'];
        $id = $_POST['review_id'];
        $query = "UPDATE reviews set content='".$content."', name='".$author."', date='".$date."' where id=". $id;
        mysqli_query($link, $query) or die("Ошибка");
        mysqli_close($link);
        echo "Данные обновлены";
    }
