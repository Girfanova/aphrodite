<div class="popup-promotion-add">
    <div class="popup-close-btn"><span id="close-promotion-add-btn">x</span></div>
    <div class="popup-content">

        <div class="popup-form">
            <p class="popup-edit-service_title">Добавление акции</p>
            <form class='form-add-promotion' id='form-add-promotion' method="post" onsubmit="add_promotion(); return false; "
                enctype="multipart/form-data">

                <div class="label">Заголовок</div>
                <div class="input-box">
                    <input type="text" id="promotion_title" name="promotion_title"
                        class="input" value="" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Описание</div>
                <div class="input-box">
                    <input type="text" id="promotion_description" name="promotion_description"
                         class="input" value=""
                        title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Фон</div>
                <div class="input-box">
                    
	                <input type='file' id='promotion_picture' name='promotion_picture'><br><br>
                   
                    <br>
                    <div class="input-message" for="" id=""></div><br>
                </div>
                
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>
</div>
<script>
   

</script>