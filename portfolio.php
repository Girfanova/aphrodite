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
        
        <div class="content-page">
        <div class="gallery">
         <?php
            $gallery_photo_arr = scandir ('Resources/Gallery');
            foreach ($gallery_photo_arr as $gallery_photo){
                if ($gallery_photo_arr[0] == $gallery_photo) continue;
                if ($gallery_photo_arr[1] == $gallery_photo) continue;
                echo "<img class='gallery-photo' src='Resources/Gallery/$gallery_photo'><img>";
            }
         ?>
         </div>   
        </div>
        <?php require_once("footer.php")?>
         <script src="script.js"></script>
    </body>
</html>
