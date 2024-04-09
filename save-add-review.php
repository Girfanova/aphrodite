<?php 
if ($_POST['review_content'] == '' or $_POST['review_author'] == '' or $_POST['review_date'] == '' ){
    echo "Пустые строки";
}
else {
    require_once('connect_db.php');
     var_dump($_POST);
    $query = "INSERT INTO reviews (content, name, date) values ('".$_POST['review_content']."', '".$_POST['review_author']."', '".$_POST['review_date']."')";
    mysqli_query($link, $query) or die("Ошибка");
    mysqli_close($link);
    echo "Отзыв добавлен";
}