<?php
session_start();
if (!empty($_POST['promotion_title']) and !empty($_POST['promotion_description'])) {
    require_once("connect_db.php");
    $id = $_POST['promotion_id'];
    $title = addslashes($_POST['promotion_title']);
    $description = addslashes($_POST['promotion_description']);
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
            $promotions = mysqli_query($link, "SELECT * from promotions where id=" . $_POST['promotion_id']);
            $row = mysqli_fetch_array($promotions);
            if ($row["picture"] != NULL) {
                unlink('Resources/promotions/' . $row['picture']);
            }
            $image = $_FILES['promotion_picture'];
            $check = check_upload($image);
            if ($check === true) {
                // upload($image);
                $img = upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла
                $query = "UPDATE promotions set title='$title', description= '$description', picture= '$img'  where id=$id";
                mysqli_query($link, $query) or die(mysqli_error($link));
                echo '<script language = "javascript">' .
                    'alert("Файл загружен");' .
                    'window.location.href="admin-panel.php"' .
                    '</script>';

            } else {
                echo '<script language = "javascript">' .
                    'alert("' . $check . '");' .
                    '</script>';
                ;
            }


        }
    }

    $query = "UPDATE promotions set title='$title', description= '$description' where id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);

} 