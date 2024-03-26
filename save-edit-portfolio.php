<?php
session_start();
require_once("connect_db.php");
var_dump($_POST);
var_dump($_FILES);
if (!empty($_POST['portfolio_description'])) {
    $id = $_POST['portfolio_id'];
    $title = $_POST['portfolio_title'];
    $description = $_POST['portfolio_description'];
    if ($_FILES['portfolio_picture']['name']) {
        $picture = $_FILES['portfolio_picture']['name'];
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
            copy($file['tmp_name'], 'Resources/portfolio/' . $file['name']);

        }

        if (isset($_FILES['portfolio_picture'])) {
            $portfolios = mysqli_query($link, "SELECT * from portfolio where id=" . $_POST['portfolio_id']);
            $row = mysqli_fetch_array($portfolios);
            if ($row["picture"] != NULL) {
                unlink('Resources/portfolio/' . $row['picture']);
            }
            $image = $_FILES['portfolio_picture'];
            $check = check_upload($image);
            if ($check === true) {
                upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла
                $query = "UPDATE portfolio set description= '$description', name= '$picture'  where id=$id";
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

    $query = "UPDATE portfolio set description= '$description' where id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));

    echo "<script>

            document.location.href = 'admin-panel.php';
            </script>";

} else
    echo "<script>
    alert('Пустые поля');
    </script>";