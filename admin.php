<?php 
session_start();
if ($_SESSION["user_role"] != 10) {
    header('Location:/');
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/style-pages.css" type="text/css">
    <!-- <link rel="stylesheet" type="text/css" href="css/lk.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <?php require_once ("header.php") ?>
    <div class="lk">
        <?php
        if ($_SESSION["user_role"] == 10) {
        echo "<div class='lk-profile'>";
        echo "<H1 class='lk-title'>Панель администратора</H1>";
        echo "<a class='admin-exit-btn profile-btn btn ' href='requests/exit.php' >Выйти</a>";
        echo "</div>";
        echo "<div id='popup' class='admin-popup'></div>";

   
            echo "
                    <div class='tab-nav'>
                        <p class='lk-title-tab label-checked' id='portfolio-table-label'>Портфолио</p>
                        <p class='lk-title-tab' id='service-table-label'>Услуги</p>
                        <p class='lk-title-tab' id='promotions-table-label'>Акции</p>
                        <p class='lk-title-tab' id='users-table-label'>Пользователи</p>
                    </div>";
                    echo "
                    <div class='record-table table-visible' id='portfolio-table'>";                     
            // require_once ('admin-portfolio.php');
            echo "
                    </div>";
            echo "<div class='record-table' id='service-table'></div>";
            echo "<div class='record-table'id='promotions-table'>";
            // require_once ('admin-promotions.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='users-table'>";
            echo "<div class='search'><input class='input-search' type=text oninput='search_user(this.value);' placeholder='Поиск'></div>";
            echo "<div id='user-list'></div>";
            // require_once('users-list.php');
            echo "
                    </div>
                    </div>";

        }
        ?>
    </div>


    <?php require_once ("footer.html")?>

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
        url: "requests/change-role.php",
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
                    document.querySelector('.input-search').value = '';
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
<!-- <script src='js/lk.js'></script>    -->
</body>

</html>