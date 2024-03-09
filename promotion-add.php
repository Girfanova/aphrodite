<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>
    <style>
        
    </style>

    <div class="popup-edit-service-container">
        <div class="popup-edit-service">
            <a href="admin-panel.php"><img src='Resources\back-btn.png'></a>
            <p class="popup-edit-service_title">Добавление акции</p>
            <form class='form-edit-service' onsubmit='return checktruevalueEdit();' method="post"
                action="save-add-promotion.php" method="post" enctype="multipart/form-data">

                <div class="label">Заголовок</div>
                <div class="input-box">
                    <input type="text" id="promotion_title" name="promotion_title" oninput="checkInputText(this);"
                        class="input" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Описание</div>
                <div class="input-box">
                    <input type="text" id="promotion_description" name="promotion_description"
                        oninput="checkInputText(this);" class="input" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Фон</div>
                <div class="input-box">
                    <input type='file' name='promotion_picture'><br><br>
                    <br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>