<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афродита</title>
    <link rel="stylesheet" href="style-header-footer.css" type="text/css">
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>

    <style>

    </style>
    <div class="lk">
        <?php
        session_start();
        $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
        mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        $portfoio = mysqli_query($link, "SELECT portfolio.id, path_big, path_small  FROM portfolio");
        echo "<div class='lk-profile'>";
        echo "<a href='lk.php'><img src='Resources\back-btn.png'></a><H1 class='lk-title'>Панель управления</H1>";
        echo "</div>";
        if ($_SESSION["user_role"] == 10) {
            echo "
                    <div class='admin-menu'>
                    <p class='lk-title label-checked' id='portfolio-table-label'>Портфолио</p>
                    <p class='lk-title' id='service-table-label'>Услуги</p>
                    <p class='lk-title' id='promotions-table-label'>Акции</p>
                    <p class='lk-title' id='contacts-table-label'></p>
                    </div>
                    <div class='record-table table-visible' id='portfolio-table'>";
            require_once('admin-portfolio.php');
            echo "
                    </div>";
            echo "<div class='record-table' id='service-table'>";
            require_once('admin-service.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='promotions-table'>";
            require_once('admin-promotions.php');
            echo "
                    </div>";
            echo "<div class='record-table' id='contacts-table'>";

            echo "
                    </div>";
        }
        ?>
    </div>


    <?php require_once("footer.php") ?>
</body>

</html>