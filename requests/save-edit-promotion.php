<?php
session_start();
require_once("connect_db.php");
var_dump($_POST);
var_dump($_FILES);
if (!empty($_POST['promotion_title']) and !empty($_POST['promotion_description'])) {
    $id = $_POST['promotion_id'];
    $title = $_POST['promotion_title'];
    $description = $_POST['promotion_description'];
    if ($_FILES['promotion_picture']['name']) {
        $picture = $_FILES['promotion_picture']['name'];
    }


    if (isset($picture)) {
        function check_upload($file)
        {
            $getMime = explode('.', $file['name']);
            $mime = strtolower(end($getMime));
            $types = array('jpg', 'gif', 'jpeg', 'png');

            if (!in_array($mime, $types))
                return 'Недопустимый тип файла';
            return true;
        }

        function upload($file)
        {
            copy($file['tmp_name'], '../Resources/promotions/' . $file['name']);

        }

        if (isset($_FILES['promotion_picture'])) {
            $promotions = mysqli_query($link, "SELECT * from promotions where id=" . $_POST['promotion_id']);
            $row = mysqli_fetch_array($promotions);
            if ($row["picture"] != NULL) {
                unlink('../Resources/promotions/' . $row['picture']);
            }
            $image = $_FILES['promotion_picture'];
            $check = check_upload($image);
            if ($check === true) {
                upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла
                $query = "UPDATE promotions set title='$title', description= '$description', picture= '$picture'  where id=$id";
                mysqli_query($link, $query) or die(mysqli_error($link));
                echo 'Успешная загрузка';

            } else {
                echo $check;
            }


        }
    }

    $query = "UPDATE promotions set title='$title', description= '$description' where id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);

} else
    echo "Пустые поля";