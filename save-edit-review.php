<?php 
if ($_POST['review_content'] = '' or $_POST['review_name'] = '' or $_POST['review_date'] = '' ){
    echo "Пустые строки";
}
else {
    require_once('connect_db.php');
    $query = "UPDATE reviews set content='".$_POST['review_content']."', name='".$_POST['review_name']."', date='".$_POST['review_date']."' where id=". $_POST['review_id'];
    echo $_POST['review_content'];
    echo $_POST['review_name'];
    echo $_POST['review_date'];
    mysqli_query($link, $query) or die("Ошибка");
    echo "Данные обновлены";
}