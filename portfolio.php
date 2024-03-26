<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
    
</head>
<style>

    

</style>
<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>

    <div class="content-page">
        <div class="gallery">
            <?php
            require_once("connect_db.php");
            $photos = mysqli_query($link,'SELECT * from portfolio');
            while ($photo = mysqli_fetch_array($photos)) {
                $photo_name= $photo['name'];
                $photo_desc= $photo['description'];
            $gallery_photo_arr = scandir('Resources/portfolio');
            foreach ($gallery_photo_arr as $gallery_photo) {
                if ($gallery_photo_arr[0] == $gallery_photo)
                    continue;
                if ($gallery_photo_arr[1] == $gallery_photo)
                    continue;
                if ($photo_name==$gallery_photo)
                echo "<a data-fancybox='images' data-caption='$photo_desc' href='Resources/portfolio/$gallery_photo'><img class='gallery-photo' title='$photo_desc' src='Resources/portfolio/$gallery_photo'><img></a>";
            }
        }
            ?>
        </div>
    </div>
    <?php require_once("footer.php") ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
</body>

</html>