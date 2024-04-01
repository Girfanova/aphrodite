<?php
require_once("connect_db.php");
if (isset($_GET["id"])) {
    $portfolio_id = $_GET['id'];
    // echo $portfolio_id;
    $portfolio = mysqli_query($link, 'SELECT * FROM portfolio where id=' . $portfolio_id);
    while ($row = mysqli_fetch_array($portfolio)) {
        $portfolio_description = $row['description'];
        $portfolio_picture = $row['name'];
    }
    mysqli_close($link);
}
?>
<div class="popup-portfolio-edit">
    <div class="popup-close-btn"><span id="close-portfolio-edit-btn">x</span></div>
    <div class="popup-content">

        <div class="popup-form">
            <p class="popup-edit-service_title">Редактирование фото портфолио</p>
            <form class='form-edit-portfolio' id='form-edit-portfolio' onsubmit='return false;' method="post"
                enctype="multipart/form-data">
                <input style='visibility:hidden;' type="text" id='portfolio_id' name='portfolio_id'
                    value="<?php echo $portfolio_id; ?>">
                    <div class="label">Фото</div>
                <div class="input-box">
                    <?php
                        echo "<img width=200px src='Resources/portfolio/" . $portfolio_picture . "'>";
                    
	                
                    ?>
                    <br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

                <div class="label">Описание</div>
                <div class="input-box">
                    <input type="text" id="portfolio_description" name="portfolio_description" class="input"
                        value="<?php echo $portfolio_description; ?>" title="Только кириллица" required><br>
                    <div class="input-message" for="" id=""></div><br>
                </div>

               
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
                
            </form>
        </div>
    </div>
</div>
<script>
    $('#form-edit-portfolio').on("submit", function () {
       var portfolio_description = document.getElementById('portfolio_description').value;
       var portfolio_id = document.getElementById('portfolio_id').value;
        $.ajax({
            url: 'save-edit-portfolio.php',
            type: 'POST',
            async: false,
            dataType: 'html',
            data: {portfolio_description:portfolio_description, portfolio_id: portfolio_id},
            success: function () {
                var popup_service_edit = document.querySelector(".popup-portfolio-edit");
                var close_serv = document.getElementById("close-portfolio-edit-btn");
                popup_service_edit.classList.remove("popup_open");
                document.body.style.overflow = "visible";
                $('#popup').html("");
            }
        });
        $.ajax({
            url: "admin-portfolio.php",
            cache: false,
            async: false,
            success: function (html) {
                $("#portfolio-table").html(html);
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