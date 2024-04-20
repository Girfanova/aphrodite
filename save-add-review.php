<?php 
    require_once('connect_db.php');
    $query = "INSERT INTO reviews (content, name, date) values ('".addslashes($_POST['review_content'])."', '".addslashes($_POST['review_author'])."', '".$_POST['review_date']."')";
    mysqli_query($link, $query) or die("Ошибка");
    mysqli_close($link);
    echo "Отзыв добавлен";
