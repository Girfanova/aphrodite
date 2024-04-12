<?php
require_once("connect_db.php");
if (isset($_GET["promotion_id"])) {
    $promotion_id = $_GET['promotion_id'];
    $promotions = mysqli_query($link, 'SELECT * FROM promotions where id=' . $promotion_id);
    while ($row = mysqli_fetch_array($promotions)) {
        $promotion_title = $row['title'];
        $promotion_description = $row['description'];
        $promotion_picture = $row['picture'];
    }
}
mysqli_close($link);
?>
<div class="popup-promotion-edit">
    <div class="popup-close-btn"><span id="close-promotion-edit-btn">x</span></div>
    <div class="popup-content" height='100%'>

        <div class="popup-form">
            <p class="popup-edit-service_title">Редактирование акции</p>
            <form class='form-edit-promotion' id='form-edit-promotion' onsubmit='return false;' method="post"
                enctype="multipart/form-data">
                <input style='visibility:hidden;' type="text" id='promotion_id' name='promotion_id'
                    value="<?php echo $promotion_id; ?>">
                <div class="label">Заголовок</div>
                <div class="input-box">
                    <input type="text" id="promotion_title" name="promotion_title" class="input"
                        value="<?php echo $promotion_title; ?>" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Описание</div>
                <div class="input-box">
                    <input type="text" id="promotion_description" name="promotion_description" class="input"
                        value="<?php echo $promotion_description; ?>" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Фон</div>
                <div class="input-box">
                    <?php
                    if ($promotion_picture)
                        echo "<img width=200px src='Resources/promotions/" . $promotion_picture . "'>
                    
	                <input type='file' id='promotion_picture' name='promotion_picture'><br><br>
                    
                    ";
                    else
                        echo "
	                <input type='file' id='promotion_picture' name='promotion_picture'><br><br>
                    ";
                    ?>
                    <br>
                    <div class="input-message" for="" id=""></div><br>
                </div>
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
                
            </form>
        </div>
    </div>
</div>
<script>
    $('#form-edit-promotion').on("submit", function () {
        var formData = new FormData();
        var file = $("#promotion_picture")[0].files[0];
        if (file != undefined) {
            var type = file.name.split('.')[1];
            if (!type.match(/(png)|(jpeg)|(jpg)|(gif)$/i)) {
                alert('Неверный тип файла - ' + file.name + '.\nЗагрузите png, jpeg, jpg, или gif.');
                return false;
            }
            else {
                formData.append("promotion_picture", file);
            }
        };
        formData.append("promotion_title", $('#promotion_title').val());
        formData.append("promotion_id", $('#promotion_id').val());
        formData.append("promotion_description", $('#promotion_description').val());
        formData.forEach(function (value, key) {
            console.log('key = ' + key + ', value = ' + value);
        });

        $.ajax({
            url: 'save-edit-promotion.php',
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            dataType: 'html',
            data: formData,
            success: function () {
                var popup_service_edit = document.querySelector(".popup-promotion-edit");
                var close_serv = document.getElementById("close-promotion-edit-btn");
                popup_service_edit.classList.remove("popup_open");
                document.body.style.overflow = "visible";
                $('#popup').html("");
            }
        });
        $.ajax({
            url: "admin-promotions.php",
            cache: false,
            async: false,
            success: function (html) {
                $("#promotions-table").html(html);
            }
        });

        return false;

        // else {
        //     formData.append("promotion_title", $('#promotion_title').val());
        //     formData.append("promotion_id", $('#promotion_id').val());
        //     formData.append("promotion_description", $('#promotion_description').val());
        //     formData.forEach(function (value, key) {
        //         console.log('key = ' + key + ', value = ' + value);
        //     });

        //     $.ajax({
        //         url: 'save-edit-promotion.php',
        //         type: 'POST',
        //         contentType: false,
        //         processData: false,
        //         async: false,
        //         dataType: 'html',
        //         data: formData,
        //         success: function (data) {
        //             console.log(data);
        //         }
        //     });
        //     $.ajax({
        //         url: "admin-promotions.php",
        //         cache: false,
        //         async: false,
        //         success: function (html) {
        //             $("#promotions-table").html(html);
        //         }
        //     });

        //     return false;
        // }

    });

</script>