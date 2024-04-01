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
    .popup-edit-service-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        background-color: var(--third-color);
    }

    .popup-edit-service {
        position: relative;
        margin: auto;
    }
</style>

<div class="popup-edit-service-container">
    <div class="popup-edit-service">
    <a href="admin-panel.php"><img src='Resources\back-btn.png'></a>
        <p class="popup-edit-service_title">Добавление услуги</p>
        <form class='form-edit-service' onsubmit='return checktruevalueEdit();' action="save-add-service.php"
            method="post">

            <div class="label">Категория</div>
            <div class="input-box">
                <select class='input' name="category_name" id="category_name" cfm_check="Y" required>
                    <?php
                    require_once("connect_db.php");
                    $categories = mysqli_query($link, 'SELECT id, category_name FROM `categories`');
                    while ($category = mysqli_fetch_array($categories)) {
                        echo "<option>" . $category['category_name'] . "</option>";
                    }
                    mysqli_close($link);
                    ?>

                </select><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Название</div>
            <div class="input-box">
                <input type="text" id="service_name" name="service_name" oninput="checkInputText(this);" class="input"
                    title="Только кириллица" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Стоимость</div>
            <div class="input-box">
                <input type="tel" id="price" name="price" class="input" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Длительность</div>
            <div class="input-box">
                <input type="tel" id="duration" name="duration" class="input" > мин.<br>
                <div class="input-message" for="" id=""></div><br>
            </div>
            <div class="label">Можно записаться?</div>
            <div class="input-box">
                <div>
                    <input type="radio" id="rec1" name="is_recording" value="1" checked  />
                    <label for="rec1">Да</label>
                </div>

                <div>
                    <input type="radio" id="rec0" name="is_recording" value="0" />
                    <label for="rec0">Нет</label>
                </div>

            </div>

            <input type="submit" value="Сохранить" class="btn form-submit-btn">
        </form>
    </div>
</div>
<?php require_once("footer.php") ?>
</body>

</html>