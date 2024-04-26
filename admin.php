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
        if ($_SESSION["user_role"] == 10) {
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
                    <p class='lk-title' id='users-table-label'>Пользователи</p>
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
            echo "<div class='record-table'id='users-table'>";
            echo "<div class='search'>Поиск <input type=text oninput='search_user(this.value);'></div>";
            echo "<div id='user-list'></div>";
            // require_once('users-list.php');
            echo "
                    </div>";

        } else {
            header('Location:index.php');

        }
        ?>
    </div>


    <?php require_once ("footer.php")?>

    <script src="js/jquery.fancybox.min.js"></script>
    <script>

//пользователи не для внедр
function search_user(value) {
    $.ajax({
        url: "users-list.php",
        cache: false,
        data: { search: value },
        success: function (php) {
            $("#user-list").html(php);
        }
    });
}
function change_role(elem, id) {
    value = elem.value;
    console.log(value+' '+id);
    $.ajax({
        url: "change-role.php",
        method:'POST',
        cache: false, 
        data: { id: id, role_id: value },
        success: function (ht) {
            console.log(ht);
            alert('Роль пользователя изменена');
            $.ajax({
                url: "users-list.php",
                cache: false,
                success: function (php) {
                    
                    $("#user-list").html(php);
                }
            });
        }
    });
}
$(document).ready(function () {
    $.ajax({
        url: "users-list.php",
        cache: false,
        success: function (php) {
            $("#user-list").html(php);
        }
    });


});
//не для внедр конец
</script>    
</body>

</html>