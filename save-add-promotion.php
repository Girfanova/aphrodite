<?php
session_start();
if (!empty($_POST['promotion_description']) and !empty($_POST['promotion_title'])) {
    $title = addslashes($_POST['promotion_title']);
    $description = addslashes($_POST['promotion_description']);
    $picture = $_FILES['promotion_picture']['name'];
    
    require_once("connect_db.php");
    // $query = "INSERT INTO promotions SET title = '$title', description = '$description', picture = '$picture'";
    // mysqli_query($link, $query);
    if ($picture) {
        function check_upload($file)
        {

            $getMime = explode('.', $file['name']);
            $mime = strtolower(end($getMime));
            $types = array('jpg', 'gif', 'jpeg', 'png');

            if (!in_array($mime, $types))
                return '<script language = "javascript">' .
                    'alert("Недопустимый тип файла");' .
                    'window.location.href=""' .
                    '</script>';

            return true;
        }

        function upload($file)
        {
            // copy($file['tmp_name'], 'Resources/promotions/' . $file['name']);
            $i = 1;
            $originalName = $file['name'];
            $fileName = $originalName;
            echo $fileName;
            while (file_exists('Resources/promotions/' . $fileName)) {
                $getM = explode(".", $fileName);
                $extension = end($getM);
                $fileName = basename($originalName, "." . $extension) . "_" . $i . "." . $extension;
                $i++;
            }
            echo $fileName;
            copy($file['tmp_name'], 'Resources/promotions/' . $fileName);
            return $fileName;

        }

        if (isset($_FILES['promotion_picture'])) {
            $image = $_FILES['promotion_picture'];
            $check = check_upload($image);
            if ($check === true) {
                // upload($image);
                $img = upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла

                $query = "INSERT INTO promotions SET title = '$title', description = '$description', picture = '$img'";
                mysqli_query($link, $query);
            } else {
                echo $check;
            }


        }
    }
    mysqli_close($link);

}

