<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php require_once("head.html")?>
        <link rel="stylesheet" href="css/style-pages.css" type="text/css">
    </head>
    <body>
    <?php require_once("header.php")?>
        
        <div class="content-page">
            <div class="title-container">
                <img class="service-image" src="Resources/реснички.jpg" alt="">
                <div class="title">Ресницы и брови</div>
            </div>
            <div class="services-list">
                
                <ul class="service-category">
                 <?php   
                    require_once("connect_db.php");
                    $service = mysqli_query($link,"SELECT services.id, service, price, category_id, category_name FROM services, categories WHERE category_id=4 and category_id=categories.id");
                     
                     while ($stroka = mysqli_fetch_array($service)) {
                        if (isset($_SESSION['auth']))
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . " <a href='make-record.php?id=" . $stroka['id'] . "'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
                    else
                        echo "<li class='service'><span>" . $stroka['service'] . "</span><span>" . $stroka['price'] . "<a href='#' onclick='openPopup();'><img title='Записаться' src='Resources/add.png'></img></a></span></li>";
               }
                     mysqli_close($link);
                ?>
                   
                </ul>
            
                
            
           </div>
        </div>
        <?php require_once("footer.html")?>
    </body>
</html>
