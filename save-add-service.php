<?php
    session_start();
    $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
    mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
    if (!empty($_POST['category_name']) and !empty($_POST['service_name']) and !empty($_POST['price']) ){
       $price = $_POST['price'];
       $category_name = $_POST['category_name'];
       $service_name = $_POST['service_name'];
       $category_id = mysqli_query($link, "SELECT id from categories where category_name='".$category_name."'");
       while ($row = mysqli_fetch_array($category_id)){
        $cat_id = $row["id"];
       };
       print_r($_POST);
       echo "$cat_id";
       $query="INSERT INTO services SET service = '$service_name', price = '$price', category_id = '$cat_id'";
       mysqli_query($link, $query);
            
            echo "<script>
            
            document.location.href = 'admin-panel.php';
            </script>";
        
    }
    else echo "<script>
    alert('Пустые поля');
    </script>";

