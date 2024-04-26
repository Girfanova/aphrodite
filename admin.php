<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
</head>

<body>
    <?php require_once ("header.php") ?>
    <div class="lk">
        <?php
        session_start();
        if ($_SESSION["auth"] == true) {
        echo "<div class='lk-profile'>";
        echo "<H1 class='lk-title'>Панель администратора</H1>";
        echo "<a class='profile-btn btn' href='exit.php' >Выйти</a>";
        echo "</div>";
        echo "<div id='popup' class='admin-popup'></div>";
            echo "
                    <div class='admin-menu'>
                    <p class='lk-title label-checked' id='portfolio-table-label'>Портфолио</p>
                    <p class='lk-title' id='service-table-label'>Услуги</p>
                    <p class='lk-title' id='promotions-table-label'>Акции</p>
                    <p class='lk-title' id='reviews-table-label'>Отзывы</p>
                    </div>
                    <div class='record-table table-visible' id='portfolio-table'>";
            // require_once ('admin-portfolio.php');
            echo "
                    </div>";
            echo "<div class='record-table' id='service-table'>";
            // require_once ('admin-service.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='promotions-table'>";
            // require_once ('admin-promotions.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='reviews-table'>";
            echo "
                    </div>";

        } else {
            echo "<form class='form-admin' method='post' action='login.php'>";
            // echo '<p>Для доступа к административной панели введите логин и пароль:</p>';
            echo '<label for="admin-login">Логин</label>';
            echo '<input type=text id="admin-login" name="login" required>';
            echo '<label for="admin-password">Пароль</label>';
            echo '<input type=password id="admin-password" name="password" placeholder="********" required>';
            echo '<button type=submit class="form-submit-btn btn">Войти</button>';
            echo '</form>';
        }
        ?>
    </div>


    <?php require_once ("footer.php")?>

    <script src="js/jquery.fancybox.min.js"></script>
    
</body>

</html>