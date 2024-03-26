
<div class="popup-service-add">
    <div class="popup-close-btn"><span id="close-service-add-btn">x</span></div>
    <div class="popup-content">
 
        <div class="popup-form">
        <p class="popup-edit-service_title">Добавление услуги</p>
        <form class='form-add-service' id='form-add-service' onsubmit="return false;"
            method="post">

            <div class="label">Категория</div>
            <div class="input-box">
                <select class='input' name="category_name" id="category_name" cfm_check="Y" required>
                    <?php
                    $categories = mysqli_query($link, 'SELECT id, category_name FROM `categories`');
                    while ($category = mysqli_fetch_array($categories)) {
                        
                            echo "<option value = ".$category['id'].">" . $category['category_name'] . "</option>";
                    }
                    ?>

                </select><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Название</div>
            <div class="input-box">
                <input type="text" id="service_name" name="service_name" oninput="checkInputText(this);" class="input"
                    value="" title="Только кириллица" required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>

            <div class="label">Стоимость</div>
            <div class="input-box">
                <input type="tel" id="price" name="price" class="input" value=""
                    required><br>
                <div class="input-message" for="" id=""></div><br>
            </div>
            
           
            <input type="submit" value="Сохранить" class="btn form-submit-btn">
        </form>
        </div>
    </div>
</div>
<script>
   
</script>