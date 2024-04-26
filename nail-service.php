<!DOCTYPE html>
<html lang="ru">
    <head>
    <?php require_once("head.php")?>
        <link rel="stylesheet" href="style-pages.css" type="text/css">
    </head>
    <body>
    <?php require_once("header.php")?>
        
        <div class="content-page">
            <div class="title-container">
                <img class="service-image" src="Resources/лаки.jpg" alt="">
                <div class="title">Ногтевой сервис</div>
            </div>
            
            <div class="services-list">
                <div class="service-category__title">Маникюр</div>
                <ul class="service-category">
                <?php 
                     require_once("connect_db.php");
                     $service = mysqli_query($link,"SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=1 and category_id=categories.id");
                     
                     while ($stroka = mysqli_fetch_array($service)) {
                        if (isset($_SESSION['auth']))
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                    else
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='#' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
               }
                ?>
            
                </ul>
            
                <div class="service-category__title">Педикюр</div>
                <ul class="service-category">
                    <?php
                    $service = mysqli_query($link,"SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=2 and category_id=categories.id");
                     
                    while ($stroka = mysqli_fetch_array($service)) {
                        if (isset($_SESSION['auth']))
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                    else
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='#' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
               }
                    ?>
                </ul>
            
                <div class="service-category__title">Дизайн</div>
                <ul class="service-category">
                    <?php
                    $service = mysqli_query($link,"SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=3 and category_id=categories.id");
                     
                    while ($stroka = mysqli_fetch_array($service)) {
                        if (isset($_SESSION['auth']))
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                    else
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='#' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
               }
                    mysqli_close($link);
                    ?>
                </ul>
            
           </div>
        </div>
        <?php require_once("footer.php")?>
    </body>
</html>
