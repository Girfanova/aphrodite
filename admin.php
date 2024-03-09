<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>
    <?php require_once("service-edit-popup.php") ?>
    <div class="lk">
        <?php
        session_start();
        require_once("connect_db.php");
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        echo "<div class='lk-profile'>";
        echo "<H1 class='lk-title'>Профиль</H1>";
        while ($stroka = mysqli_fetch_array($user)) {
            echo "<div class='profile-table'>";
            echo "<div class='profile-circle'>" . mb_substr($stroka['name'], 0, 1) . "</div>";
            echo "<div>
                    <div><b> {$stroka['surname']} {$stroka['name']}</b></div>
                    <div>Телефон: {$stroka['phone']}</div>
                    <div class='lk-role'><b> {$stroka['role_name']}</b></div>
                </div>";

            echo "<div><div><a class='btn profile-btn' href='edit-profile.php'>Редактировать</a></div><div><a class='profile-btn btn' href='exit.php'>Выйти</a></div></div>";

            echo "</div>";
        }
        echo "</div>";
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        $portfoio = mysqli_query($link, "SELECT portfolio.id, path_big, path_small  FROM portfolio");
        echo "<div class='lk-profile'>";
        echo "<H1 class='lk-title'>Административная панель</H1>";
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
    <script>
    //     $(document).ready(function(){
		
    //     $('#promotions-table-label').click(function(){
    //         $.ajax({
    //             url: "admin-promotions.php",
    //             cache: false,
    //             success: function(php){
    //                 $("#promotions-table").html(php);
    //             }
    //         });
    //     });
        
        
    // });
	function portfolio_delete(name) {
		$.ajax({
			url: '/portfolio-photo-delete.php',         /* Куда отправить запрос */
			method: 'get',             /* Метод запроса (post или get) */
            async: false,
			dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
			data: { name_image: name },     /* Данные передаваемые в массиве */
			success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
				console.log(data); /* В переменной data содержится ответ от index.php. */
			}
		});
	
        $.ajax({
                url: "admin-portfolio.php",
                cache: false,
                success: function(php){
                    $("#portfolio-table").html(php);
                }
            });
	}
	function service_delete(id) {
		$.ajax({
			url: '/service-delete.php',         
			method: 'get',             
            async: false,
			dataType: 'html',          
			data: { service_id: id },    
			success: function (data) {  
				console.log(data); 
			}
		});
        $.ajax({
                url: "admin-service.php",
                cache: false,
                success: function(php){
                    $("#service-table").html(php);
                }
            });
	}
	function promotion_delete(id) {
		$.ajax({
			url: '/promotion-delete.php',         /* Куда отправить запрос */
			method: 'get',             /* Метод запроса (post или get) */
            async: false,
			dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
			data: { promotion_id: id },     /* Данные передаваемые в массиве */
			success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
				console.log(data); /* В переменной data содержится ответ от index.php. */
			}
		});
        $.ajax({
                url: "admin-promotions.php",
                cache: false,
                success: function(html){
                    $("#promotions-table").html(html);
                }
            });
	}
</script>
</body>

</html>