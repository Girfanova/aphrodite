<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
</head>
<style>
.form-admin{
    width: 30%;
    min-width: 300px;
    height:30vh;
    margin: 5% auto;
    display: flex;
    border: 2px var(--third-color) solid;
    padding: 5%;
    border-radius: 10px;
    flex-direction: column;
    justify-content: space-evenly;
}
</style>
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
            require_once ('admin-portfolio.php');
            echo "
                    </div>";
            echo "<div class='record-table' id='service-table'>";
            require_once ('admin-service.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='promotions-table'>";
            require_once ('admin-promotions.php');
            echo "
                    </div>";
            echo "<div class='record-table'id='reviews-table'>";
            echo "
                    </div>";

        } else {
            echo "<form class='form-admin' method='post' action='login.php'>";
            echo '<p>Для доступа к административной панели введите логин и пароль:</p>';
            echo '<label for="admin-login">Логин</label>';
            echo '<input type=text id="admin-login" name="login" required>';
            echo '<label for="admin-password">Пароль</label>';
            echo '<input type=password id="admin-password" name="password"  required>';
            echo '<button type=submit class="form-submit-btn">Войти</button>';
            echo '</form>';
        }
        ?>
    </div>


    <?php require_once ("footer.php")?>

    <script src="js/jquery.fancybox.min.js"></script>
    <script>

        
        //для внедр
        function portfolio_delete(id) {
            if (confirm("Вы хотите удалить фото?")){
            $.ajax({
                url: '/portfolio-photo-delete.php',        
                method: 'get',             
                async: false,
                dataType: 'html',          
                data: { id_image: id },     
                success: function (data) {   
                    $('#admin-portfolio' + id).remove(); 
                }
            });
        }
        }
        function service_delete(id, service_id) {
            if (confirm("Вы хотите удалить услугу?")){
            $.ajax({
                url: '/service-delete.php',
                method: 'get',
                async: false,
                dataType: 'html',
                data: { service_id: id },
                success: function (data) {
                    $('#admin-service' + id).remove(); 
                    let row = $('#admin-category-service' + service_id).attr('rowspan');
                    $('#admin-category-service' + service_id).attr('rowspan', row-'1');
                }
            });}
        }
        function promotion_delete(id) {
            if (confirm("Вы хотите удалить акцию?")){
            $.ajax({
                url: '/promotion-delete.php',        
                method: 'get',            
                async: false,
                dataType: 'html',         
                data: { promotion_id: id },     
                success: function (data) {   
                    $('#admin-promotion' + id).remove(); 
                }
            });
        }
        }
    </script>
    
</body>

</html>