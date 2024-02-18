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
        <style>
.button {
    background-color: #E7CCDE;
    padding: 1%;
    font-size: 1.4em;
    border: 1px solid grey;
    cursor: pointer;
}
        .feedback-title{
            font-size:2em;
            width:50%;
            margin:2% auto;
        }
        .popup-form__feedback{
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            width:50%;
            margin:auto;
        }
        .label{
            font-size:1.6em;
        }
            </style>
    <?php require_once("header.php")?>
    <?php require_once("auth.php")?>
        
        <div style="padding:10vh;" class="content-page">
        <div class="feedback-title">Свяжитесь с нами</div>
        <form class="popup-form__feedback" action="feedback.php" method="POST">
       
                    <div class="label">Номер телефона</div><div class="input-box">
                        <input type="text" id="phone_feedback"  name="phone_feedback" class="input" placeholder="+7 (000) 000-00-00" required><br>
                        <br>
                        </div>

                        <div class="label">Фамилия</div><div class="input-box">
                        <input type="text" id="surname_feedback"  name="surname_feedback" class="input"  required><br>
                        <br>
                        </div>
                        
                        <div class="label">Имя</div><div class="input-box">
                        <input type="text" id="name_feedback"  name="name_feedback" class="input"  required><br>
                        <br>
                        </div>
                        <input type="submit" class="button" value="Отправить">  
                    </form>

        </div>
        <?php require_once("footer.php")?>
    </body>
</html>


