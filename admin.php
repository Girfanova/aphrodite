<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Афродита</title>
        <link rel="stylesheet" href="style-header-footer.css" type="text/css">
        <link rel="stylesheet" href="style-pages.css" type="text/css">
    </head>
    <body>
    <?php require_once("header.php")?>
    <?php require_once("auth.php")?>
        
        <style>
            td{padding:20px; border:;}
            tr:hover{background:#e0e5e9;}
            table{width:55%;background:white; border:1px}
            a:hover{color:rgb(190, 21, 96);}
        </style>
        <div class="admin-menu" style="min-height: 40vh; padding:10% 0;font-size:2em; ">
        <?php 
            $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
            mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
            $users = mysqli_query($link,"SELECT users.id, surname, name, role_name, role_id FROM users, roles WHERE users.role_id = roles.id ORDER BY users.id");
            echo '<center><table border=1>';
            while ($stroka = mysqli_fetch_array($users)) {
            echo "<tr>";
            echo "<td> {$stroka['surname']} {$stroka['name']}</td>";
            echo "<td> {$stroka['role_name']} </td>";
            echo "<td><a href='delete-user.php?id=".$stroka['id']."'>Удалить</a></td>";
            if ($stroka['role_id'] == '10') echo "<td><a href='edit-user.php?id=".$stroka['id']."&role_id=".$stroka['role_id']."'>Сделать его пользователем</a></td>";
            else echo "<td><a href='edit-user.php?id=".$stroka['id']."&role_id=".$stroka['role_id']."'>Сделать его администратором</a></td>";
            echo "</tr>";
            }
            echo '</table></center>';
        ?>
        </div>
        <?php require_once("footer.php")?>
         <script src="script.js"></script>
    </body>
</html>