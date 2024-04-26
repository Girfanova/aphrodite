<?php
require_once("connect_db.php");
if (!empty($_POST['promotion_description']) and !empty($_POST['promotion_title'])) {
    $title = $_POST['promotion_title'];
    $description = $_POST['promotion_description'];
    $picture = $_FILES['promotion_picture']['name'];

    $query = "INSERT INTO promotions SET title = '$title', description = '$description', picture = '$picture'";
    mysqli_query($link, $query);
    if ($picture) {
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
            $image = $_FILES['promotion_picture'];
            $check = check_upload($image);
            if ($check === true) {
                upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла
                echo 'Успешная загрузка';

            } else {
                echo $check;
            }


        }
    }
    mysqli_close($link);

} else
    echo "'Пустые поля";

