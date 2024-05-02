<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">

</head>

<body>
    <?php require_once ("header.php") ?>

    <div class="content-page">
        <div class="portfolio__title">Портфолио</div>
        <!-- <hr> -->
        <div class="gallery">
            <?php
            require_once ("connect_db.php");
            $photos = mysqli_query($link, 'SELECT * from portfolio order by id desc');
            $count=1;
            $gallery_photo_arr = scandir('Resources/portfolio');
            while ($photo = mysqli_fetch_array($photos)) {
                $photo_name = $photo['name'];
                $photo_desc = $photo['description'];
                foreach ($gallery_photo_arr as $gallery_photo) {
                    if ($gallery_photo_arr[0] == $gallery_photo)
                        continue;
                    if ($gallery_photo_arr[1] == $gallery_photo)
                        continue;
                    if ($photo_name == $gallery_photo){
                        echo "<div class='portfolio-image' onclick='openModal();currentSlide($count);'><img class='gallery-photo hover-shadow' title='$photo_desc' src='Resources/portfolio/$gallery_photo'><img></div>";
                        $count++;
                    }
                }
            }
            echo ' </div>
            <div id="myModal" class="modal">
                <span class="close cursor" onclick="closeModal()">&times;</span>
            ';
            $k=1; 
            $count--;
            $photos = mysqli_query($link, 'SELECT * from portfolio order by id desc');
            while ($photo = mysqli_fetch_array($photos)) {
                $photo_name = $photo['name'];
                $photo_desc = $photo['description'];

                echo "
                    <div class='mySlides'>
                        <div class='numbertext'>$k / $count</div>
                        <img src='Resources/portfolio/".$photo_name."' class='popup-photo'>
                        <p class='portf-desc'>$photo_desc</p>
                    </div>
                    ";
                    $k++;
                }
            ?>


            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
    </div>
    <?php require_once ("footer.php") ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/gallery.js"></script>
</body>

</html>