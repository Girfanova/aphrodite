<?php
require_once ("connect_db.php");
if (isset ($_GET["service_id"])) {
    $service_id = $_GET['service_id'];
    $services = mysqli_query($link, 'SELECT category_id, service, price, category_name, duration_in_min, is_recording FROM services, categories where services.id=' . $service_id);
    while ($row = mysqli_fetch_array($services)) {
        $service_name = $row['service'];
        $service_price = $row['price'];
        $service_category_id = $row['category_id'];
        $service_duration = $row['duration_in_min'];
        $service_recording = $row['is_recording'];
    }
}
?>
<div class="popup-service-edit">
    <div class="popup-close-btn"><span id="close-service-edit-btn">x</span></div>
    <div class="popup-content">

        <div class="popup-form">
            <p class="popup-edit-service_title">Редактирование услуги</p>
            <form class='form-edit-service' id='form-edit-service' onsubmit="return false;" method="post">

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
                        mysqli_close($link);
                        ?>

                    </select><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Название</div>
                <div class="input-box">
                    <input type="text" id="service_name" name="service_name" oninput="checkInputText(this);"
                        class="input" value="<?php echo $service_name; ?>" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Стоимость</div>
                <div class="input-box">
                    <input type="tel" id="price" name="price" class="input" value="<?php echo $service_price; ?>"
                        required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>
                <div class="label">Длительность</div>
                <div class="input-box">
                    <input type="tel" id="duration" name="duration" class="input"
                        value="<?php echo $service_duration; ?>" <?php if ($service_recording) {
                               echo 'required';
                           }
                           ; ?>>
                    мин.<br>
                    <div class="input-message" for="" id=""></div><br>
                </div>
                <div class="label">Можно записаться?</div>
                <div class="input-box">
                    <div>
                        <input type="radio" id="rec1" name="is_recording" value="1" <?php if ($service_recording) {
                            echo 'checked';
                        }
                        ; ?> />
                        <label for="rec1">Да</label>
                    </div>

                    <div>
                        <input type="radio" id="rec0" name="is_recording" value="0" <?php if (!$service_recording) {
                            echo 'checked';
                        }
                        ; ?> />
                        <label for="rec0">Нет</label>
                    </div>

                </div>
                <input style='visibility:hidden;' type="text" id='service_id' name='service_id'
                    value="<?php echo $service_id; ?>">
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>
</div>
<script>
    $('#form-edit-service').on("submit", function () {
        var dataForm = $(this).serialize()
        $.ajax({
            url: 'save-edit-service.php',
            method: 'post',
            async: false,
            dataType: 'html',
            data: dataForm,
            success: function (data) {
                alert(data); var popup_service_edit = document.querySelector(".popup-service-edit");
                popup_service_edit.classList.remove("popup_open");
                document.body.style.overflow = "visible";
                $('#popup').html = '';
            }
        });
        $.ajax({
            url: "admin-service.php",
            cache: false,
            async: false,
            success: function (html) {
                $("#service-table").html(html);
            }
        });
        return false;
    })

</script>