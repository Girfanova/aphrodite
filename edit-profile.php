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
    <?php require_once("header.php")?>
    <?php require_once("auth.php")?>
        
        <style>
            .lk{
                font-size:2em;
                padding:13vh 7% 0 7%;
                
            }
            .lk a:hover{
                    color:red;
                }
            .lk    a{
                    color:grey;
                }
            .lk-title{
                font-size:2em;
                padding:3% 0 2% 0;
                
            }
            .form-edit-profile{
                width:60%;
                margin:1% auto 5% auto;
                display: flex;
                flex-wrap: wrap;
                font-size:0.7em;
                padding:2%;
                justify-content: space-around;
                
                border: 1px solid grey;
            }
            .lk-profile{
                
                min-height:40vh;
            }
            .input-message{
                margin-top:-2%;
            }
            
             .button{
                background-color:#E7CCDE;
                padding:1%;
                font-size:1.1em;
                border:1px solid grey;
                cursor:pointer;
            }
            .lk img{
                padding:0 5% 0 0;
                width:40px;
                height:20px;
            }
            
        </style>
        <div class="lk">
         
            <div class='lk-profile'>
            <a href='lk.php'> <img src='Resources/arrow-back.png' title='Назад'> </a>  
                <span class='lk-title'>Редактирование профиля</span>
            <?php 
                session_start();
                $link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
                $user = mysqli_query($link,"SELECT users.id, surname, name,  phone FROM users  WHERE users.id = " . $_SESSION["user_id"]);
                while ($stroka = mysqli_fetch_array($user)) {
                    $id = $_SESSION["user_id"];
                    $name= $stroka["name"];
                    $surname= $stroka["surname"];
                    $phone= $stroka["phone"];
                }
                ?>
                
                <form class='form-edit-profile' onsubmit='return checktruevalueEdit();' action="save_edit-profile.php" method="post">
                    
                        <div class="label">Фамилия</div>
                        <div class="input-box">
                        <input type="text" id="surname_edit" name="surname_edit" oninput="checkInputText(this);" class="input" title="Только кириллица" value="<?php echo $surname; ?>" required><br>
                        <div class="input-message" for="surname_edit" id="surname_edit_label"></div><br>
                        </div>
                        
                        <div class="label">Имя</div><div class="input-box">
                        <input type="text" id="name_edit" name="name_edit" oninput="checkInputText(this);" class="input" value="<?php echo $name; ?>" title="Только кириллица"required><br>
                        <div class="input-message" for="name_edit" id="name_edit_label"></div><br>
                        </div>
                        
                        <div class="label">Номер телефона</div><div class="input-box">
                        <input type="tel" id="tel" name="phone_edit" class="input" value="<?php echo $phone; ?>" placeholder="+7 (000) 000-00-00" required><br>
                        <div class="input-message" for="phone_edit" id="phone_edit_label"></div><br>
                        </div>
	                    <input type="submit" value="Сохранить" class="btn form-submit-btn">
	            </form>
            </div>
            </div>
        
        <?php require_once("footer.php")?>
    </body>
</html>