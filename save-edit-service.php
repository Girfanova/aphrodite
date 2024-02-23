<?php
    session_start();
    $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
    mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
    if (!empty($_POST['category_name']) and !empty($_POST['service_name']) and !empty($_POST['price']) ){
       $price = $_POST['price'];
       $category_name = $_POST['category_name'];
       $service_name = $_POST['service_name'];
       $service_id = $_POST['service_id'];
       $service_duration = $_POST['duration'];
       $service_recording = $_POST['is_recording'];
       $category_id = mysqli_query($link, "SELECT id from categories where category_name='".$category_name."'");
       while ($row = mysqli_fetch_array($category_id)){
        $cat_id = $row["id"];
       };
       print_r($_POST);
       echo "$cat_id";
            $query="UPDATE services set service='".$service_name."', price=$price, category_id=$cat_id,duration_in_min=$service_duration, is_recording=$service_recording where id=$service_id";
            mysqli_query($link, $query);
            
            echo "<script>
            
            document.location.href = 'admin-panel.php';
            </script>";
        
    }
    else echo "<script>
    alert('Пустые поля');
    </script>";
