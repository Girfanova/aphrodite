<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
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
        require_once("connect_db.php");
        $user = mysqli_query($link, "SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.id = " . $_SESSION["user_id"] . " and role_id=roles.id");
        echo "<div class='lk-profile'>";
        echo "<a href='lk.php'><img src='Resources\back-btn.png'></a><H1 class='lk-title'>Учет посещений</H1>";

        echo "</div>";
        if ($_SESSION["user_role"] == 3) {

            
            echo "<div class='admin-menu'>";
            
            // echo "<div class=''>Сортировать:<select id='sort-select'>
            // <option>по дате новые</option>
            // <option>по дате старые</option>
            // </select></div>";
            echo "<div class=''>Фильтровать по мастерам: <select id='filter-select' onchange='do_filter();'>";
            echo "<option value='000'>Все</option>";
            $masters = mysqli_query($link,"SELECT * from masters") or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($masters)) {
                echo "<option value='".$row['id']."'>".$row['name']." ".$row['surname']."</option>";
            }
            echo "</select></div>";
            echo "<table class='record-table table-visible' id='record-table'>";
            echo "<tr>
                   <th width=14%>Клиент</th>
                   <th width=15%>Телефон клиента</th>
                   <th width=14%>Мастер</th>
                   <th width=22%>Услуга</th>
                   <th width=10%>Дата</th>
                   <th width=7%>Время</th>
                   <th width=9%>Отменить</th>
                   <th width=9%>Выполнено</th>
                   </tr>";
                echo '<tbody id="record-list-table" width=100%></tbody>';
            echo '</table>
                            ';

            echo '</div>';
        }
        mysqli_close($link);
        ?>
    </div>


    <?php require_once("footer.php") ?>
</body>
<script>
    $(document).ready(function(){
        select = document.getElementById('filter-select').value;
        $.ajax({
            url: 'record-list-table.php',       
			method: 'get',            
            async: false,
			dataType: 'html',          
			data:{select:select},    
			success: function (data) {   
				document.getElementById('record-list-table').innerHTML = data; 
			}
        })
    })
    function do_filter(){
        select = document.getElementById('filter-select').value;
        $.ajax({
            url: 'record-list-table.php',       
			method: 'get',            
            async: false,
			dataType: 'html',          
			data:{select:select},    
			success: function (data) {   
				document.getElementById('record-list-table').innerHTML = data; 
			}
        })
    }
    </script>
</html>