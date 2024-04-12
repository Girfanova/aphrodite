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
        require_once ("connect_db.php");
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        $portfoio = mysqli_query($link, "SELECT *  FROM portfolio");
        if ($_SESSION['user_role']== 10){
        
        echo "<div class='lk-profile' style='flex-wrap:nowrap;'>";
        echo "<H1 class='lk-title' style='padding-right:5%;'>Административная панель</H1>";
        echo "<a class='profile-btn btn' href='exit.php' style='width:20%'>Выйти</a>";
        echo "<div id='popup' class='admin-popup'></div>";
        echo "</div>";


            echo "
                    <div class='admin-menu'>
                    <p class='lk-title label-checked' id='portfolio-table-label'>Портфолио</p>
                    <p class='lk-title' id='service-table-label'>Услуги</p>
                    <p class='lk-title' id='promotions-table-label'>Акции</p>
                    <p class='lk-title' id='users-table-label'>Пользователи</p>
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
            echo "<div class='record-table'id='users-table'>";
            echo "<div>Поиск <input type=text oninput='search_user(this.value);'></div>";
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