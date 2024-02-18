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
<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "aphrodite") or die("Ошибка подключения к базе данных");
$service_id = $_GET['service_id'];
$services = mysqli_query($link, 'SELECT category_id, service, price, category_name FROM services, categories where services.id=' . $service_id);
while ($row = mysqli_fetch_array($services)) {
    $service_name = $row['service'];
    $service_price = $row['price'];
    $service_category_id = $row['category_id'];
}
?>
<div class="popup-edit-service-container">
    <div class="popup-edit-service">
        <p class="popup-edit-service_title">Редактирование услуги</p>
        <form class='form-edit-service' onsubmit='return checktruevalueEdit();' action="save-edit-service.php"
            method="post">

            <div class="label">Категория</div>
            <div class="input-box">
                <select class='input' name="category_name" id="category_name" cfm_check="Y" required>
                    <?php
                    $categories = mysqli_query($link, 'SELECT id, category_name FROM `categories`');
                    while ($category = mysqli_fetch_array($categories)) {
                        if ($category['id'] == $service_category_id)
                            echo "<option selected='selected'>" . $category['category_name'] . "</option>";
                        else
                            echo "<option>" . $category['category_name'] . "</option>";
                    }
                    ?>

                </select><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Название</div>
            <div class="input-box">
                <input type="text" id="service_name" name="service_name" oninput="checkInputText(this);" class="input"
                    value="<?php echo $service_name; ?>" title="Только кириллица" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Стоимость</div>
            <div class="input-box">
                <input type="tel" id="price" name="price" class="input" value="<?php echo $service_price; ?>"
                    required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>
            <input style='visibility:hidden;' type="text" id='service_id' name='service_id' value="<?php echo $service_id; ?>">
            <input type="submit" value="Сохранить" class="btn form-submit-btn">
        </form>
    </div>
</div>