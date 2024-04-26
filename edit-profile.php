<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/style-pages.css" type="text/css">
</head>

<body>
    <?php require_once ("header.php") ?>

    <style>
        .lk {
            font-size: 2em;
            padding: 13vh 7% 0 7%;

        }

        .lk a:hover {
            color: red;
        }

        .lk a {
            color: grey;
        }

        .lk-title {
            font-size: 2em;
            margin: 0 0 5% 0;
            width: 100%;
            text-align: center;
        }

        .form-edit-profile,
        .form-change-password {
            width: 60%;
            margin: 1% 2% 5% 2%;
            display: flex;
            flex-wrap: wrap;
            font-size: 0.7em;
            padding: 2%;
            justify-content: space-around;
            border: 1px solid grey;
            height: 100%;
        }

        .lk-profile {
            align-items: baseline;
            min-height: 40vh;
            flex-wrap: nowrap;
        }

        .input-message {
            margin-top: -2%;
        }

        .button {
            background-color: #E7CCDE;
            padding: 1%;
            font-size: 1.1em;
            border: 1px solid grey;
            cursor: pointer;
        }

        .lk img {
           
        }
    </style>
    <div class="lk">

        <div class='lk-profile'>
            <a href='lk.php'> <img class='back-btn' src='Resources/back-btn.png' title='Назад'> </a>
            <?php
            session_start();
            require_once ("connect_db.php");
            $user = mysqli_query($link, "SELECT users.id, surname, name,  phone FROM users  WHERE users.id = " . $_SESSION["user_id"]);
            while ($stroka = mysqli_fetch_array($user)) {
                $id = $_SESSION["user_id"];
                $name = $stroka["name"];
                $surname = $stroka["surname"];
                $phone = $stroka["phone"];
            }
            mysqli_close($link);
            ?>
            <!-- смена номера и имени -->
            <form class='form-edit-profile' id='form-edit-profile'  onsubmit='return checktruevalueEdit();' action="requests/save_edit-profile.php"
                method="post">

                <span class='lk-title'>Редактирование профиля</span>

                <div class="label">Фамилия</div>
                <div class="input-box">
                    <input type="text" id="surname_edit" name="surname_edit" oninput="checkInputText(this);"
                        class="input" title="Только кириллица" value="<?php echo $surname; ?>" required><br>
                    <div class="input-message" for="surname_edit" id="surname_edit_label"></div><br>
                </div>

                <div class="label">Имя</div>
                <div class="input-box">
                    <input type="text" id="name_edit" name="name_edit" oninput="checkInputText(this);" class="input"
                        value="<?php echo $name; ?>" title="Только кириллица" required><br>
                    <div class="input-message" for="name_edit" id="name_edit_label"></div><br>
                </div>

                <div class="label">Номер телефона</div>
                <div class="input-box">
                    <input type="tel" id="tel" name="phone_edit" class="input" value="<?php echo $phone; ?>"
                        placeholder="+7 (000) 000-00-00" required><br>
                    <div class="input-message" for="phone_edit" id="phone_edit_label"></div><br>
                </div>
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>

            <!-- смена пароля -->
            <form class='form-change-password' id ='form-change-password' onsubmit='return false;'>
                <span class='lk-title'>Смена пароля</span>

                <div class="label">Старый пароль</div>
                <div class="input-box">
                    <input type="password" name="old-password" id="old-password" class="input"
                        placeholder="********" title="Минимум 8 символов" required minlength='8'><br>
                    <div class="input-message" for="old-password" id="old-password-label"></div><br>
                </div>
                <div class="label">Новый пароль</div>
                <div class="input-box">
                    <input type="password" name="new-password" id="new-password" class="input"
                        placeholder="********" title="Минимум 8 символов" required minlength='8'><br>
                    <div class="input-message" for="new-password" id="new-password-label"></div><br>
                </div>
                <div class="label">Повторите новый пароль</div>
                <div class="input-box">
                    <input type="password" name="new-password1" id="new-password1" class="input"
                        placeholder="********" title="Минимум 8 символов" required minlength='8'><br>
                    <div class="input-message" for="new-password1" id="new-password1-label"></div><br>
                </div>
                <input type="submit" value="Сохранить" class="btn form-submit-btn">
            </form>
        </div>
    </div>

    <?php require_once ("footer.html") ?>
</body>

</html>