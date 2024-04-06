<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
</head>

<body>
    <?php require_once("header.php") ?>
    <style>
    
</style>
<?php
require_once("connect_db.php");
$promotion_id = $_GET['promotion_id'];
$promotions = mysqli_query($link, 'SELECT * FROM promotions where id=' . $promotion_id);
while ($row = mysqli_fetch_array($promotions)) {
    $promotion_title = $row['title'];
    $promotion_description = $row['description'];
    $promotion_picture = $row['picture'];
}
mysqli_close($link);
?>
<div class="popup-edit-service-container">
    <div class="popup-edit-service">
    <a href="admin-panel.php"><img src='Resources\back-btn.png'></a>
        <p class="popup-edit-service_title">Редактирование акции</p>
        <form class='form-edit-service' onsubmit='return checktruevalueEdit();' method="post" action="save-edit-promotion.php"
            method="post" enctype="multipart/form-data">

            <div class="label">Заголовок</div>
            <div class="input-box">
                <input type="text" id="promotion_title" name="promotion_title" oninput="checkInputText(this);" class="input"
                    value="<?php echo $promotion_title; ?>" title="Только кириллица" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Описание</div>
            <div class="input-box">
                <input type="text" id="promotion_description" name="promotion_description" oninput="checkInputText(this);" class="input"
                    value="<?php echo $promotion_description; ?>" title="Только кириллица" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Фон</div>
            <div class="input-box">
                <?php
                if ($promotion_picture)
                    echo "<img width=200px src='Resources/promotions/" . $promotion_picture . "'>
                    
	                <input type='file' name='promotion_picture'><br><br>
                    
                    ";
                else
                    echo "
	                <input type='file' name='promotion_picture'><br><br>
                    ";
                ?>
                <br>
                <div class="input-message" for="" id=""></div><br>
            </div>
            <input style='visibility:hidden;' type="text" id='promotion_id' name='promotion_id'
                value="<?php echo $promotion_id; ?>">
            <input type="submit" value="Сохранить" class="btn form-submit-btn">
        </form>
    </div>
</div>
<?php require_once("footer.php") ?>
</body>

</html>