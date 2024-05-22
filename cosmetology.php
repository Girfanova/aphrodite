<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/style-pages.css" type="text/css">
</head>

<body>
    <?php require_once ("header.php") ?>

    <div class="content-page">
        <div class="title-container">
            <img class="service-image" src="Resources/маски.jpg" alt="">
            <div class="title">Косметология</div>
        </div>

        <div class="services-list">
            <div class="service-category__title">Массаж лица</div>
            <ul class="service-category">
                <?php
                require_once ("connect_db.php");
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=5 and category_id=categories.id");
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " ";
                    if ($stroka['is_recording'] == 1) {
                        if (isset($_SESSION['auth'])) 
                        echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    else echo "<a href='javascript:void(0);' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a>";
                    }
                    echo "</span></li>";    
                }
                ?>
            </ul>

            <div class="service-category__title">Уход за лицом</div>
            <ul class="service-category">
                <?php
                $service = mysqli_query($link, "SELECT is_recording, services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=6 and category_id=categories.id");
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " ";
                    if ($stroka['is_recording'] == 1) {
                        if (isset($_SESSION['auth'])) 
                        echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    else echo "<a href='javascript:void(0);' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a>";
                    }
                    echo "</span></li>";   
                }
                ?>
            </ul>

            <div class="service-category__title">Маски</div>
            <ul class="service-category">
                <?php
                $service = mysqli_query($link, "SELECT is_recording, services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=7 and category_id=categories.id");
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " ";
                    if ($stroka['is_recording'] == 1) {
                        if (isset($_SESSION['auth'])) 
                        echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    else echo "<a href='javascript:void(0);' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a>";
                    }
                    echo "</span></li>";   
                }
                ?>
            </ul>

            <div class="service-category__title">Пилинг кислотный</div>
            <ul class="service-category">
                <?php
                $service = mysqli_query($link, "SELECT is_recording, services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=8 and category_id=categories.id");
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " ";
                    if ($stroka['is_recording'] == 1) {
                        if (isset($_SESSION['auth'])) 
                        echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    else echo "<a href='javascript:void(0);' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a>";
                    }
                    echo "</span></li>";   
                }
                mysqli_close($link);
                ?>
            </ul>



        </div>
    </div>
    <?php require_once ("footer.html") ?>

</body>

</html>