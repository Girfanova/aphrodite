<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афродита</title>
    <link rel="stylesheet" href="style-header-footer.css" type="text/css">
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>

    <div class="content-page">
        <div class="title-container">
            <img class="service-image" src="Resources/волосы.jpg" alt="">
            <div class="title">Парикмахерские услуги</div>
        </div>
        <div class="services-list">
            <div class="service-category__title">Для милых дам</div>
            <ul class="service-category">
                <?php
                $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");

                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=10 and category_id=categories.id");
                echo "<li class='service__title'>Стрижка</li>";
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. ";
                   if ($stroka['is_recording']==1) echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                   echo "</span></li>";
                }

                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=11 and category_id=categories.id");
                echo "<li class='service__title'>Укладка</li>";
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. ";
                    if ($stroka['is_recording']==1) echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    echo "</span></li>";
                 }
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=12 and category_id=categories.id");
                echo "<li class='service__title'>Окрашивание</li>";
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. ";
                    if ($stroka['is_recording']==1) echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    echo "</span></li>";
                 }
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=13 and category_id=categories.id");
                echo "<li class='service__title'>Химическая завивка</li>";
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. ";
                    if ($stroka['is_recording']==1) echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                    echo "</span></li>";
                 }
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name, is_recording FROM services, categories WHERE category_id=14 and category_id=categories.id");
                echo "<li class='service__title'>Парфюмерия</li>";
                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. ";
                   if ($stroka['is_recording']==1) echo "<a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a>";
                   echo "</span></li>";
                }

                ?>
            </ul>

            <div class="service-category__title">Для мужчин</div>
            <ul class="service-category">
                <?php
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=15 and category_id=categories.id");

                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                }
                ?>
            </ul>

            <div class="service-category__title">Для детей</div>
            <ul class="service-category">
                <?php
                $service = mysqli_query($link, "SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=16 and category_id=categories.id");

                while ($stroka = mysqli_fetch_array($service)) {
                    echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " руб. <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                }
                ?>
            </ul>

        </div>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>