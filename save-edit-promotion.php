<?php
session_start();
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
if (!empty($_POST['promotion_title']) and !empty($_POST['promotion_description'])) {
    $id = $_POST['promotion_id'];
    $title = $_POST['promotion_title'];
    $description = $_POST['promotion_description'];
    if ($_FILES['promotion_picture']['name']) {
        $picture = $_FILES['promotion_picture']['name'];
    }
    
    $promotions = mysqli_query($link, "SELECT * from promotions where id=" . $_POST['promotion_id']);
    $row = mysqli_fetch_array($promotions);
    if ($row["picture"] != NULL) {
        unlink('Resources/promotions/' . $row['picture']);
    }
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
            copy($file['tmp_name'], 'Resources/promotions/' . $file['name']);

        }

        if (isset($_FILES['promotion_picture'])) {
            $image = $_FILES['promotion_picture'];
            $check = check_upload($image);
            if ($check === true) {
                upload($image);
                $getMime = explode('.', $image['name']);

                $mime = strtolower(end($getMime)); //тип фала
                $name = reset($getMime); //имя файла
                $query = "UPDATE promotions set title='$title', description= '$description', picture= '$picture'  where id=$id";
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

    echo "<script>

            document.location.href = 'admin-panel.php';
            </script>";

} else
    echo "<script>
    alert('Пустые поля');
    </script>";