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
        
        <div class="content-page">

            <div class="about-us">
                  <div class="about-us__text">
                    <div class="about-us__title">О нас</div>
                    <span class="first-word">Салон красоты "Афродита" </span> — это целый мир, в котором Вы можете провести время с комфортом в дали от повседневной деятельности. 
                    В этом Вам помогут наш обходительный и вежливый персонал, располагающая обстановка и расслабляющая, мелодичная музыка. 
                    У нас Вы сможете отвлечься от проблем и будничной суеты.<br><br>
                    Мы ценим каждого нашего клиента. Основная цель нашей работы - это безостановочное стремление к идеалу. Вашему идеалу. 
                    Для нас по-настоящему важно, чтобы клиенты не сомневались в нашей компетентности, поэтому мы предлагаем только лучшее. 
                  </div>
                  <div class="slider">
                    <button class="prew-btn"></button>
                    <div class="slider__wrapper">
                      <div class="slider__items">
                            <img src="Resources/slider1.jpg" class="slider__item" alt="Фото салона1">
                            <img src="Resources/slider2.jpg" class="slider__item" alt="Фото салона2">
                            <img src="Resources/slider3.jpg" class="slider__item" alt="Фото салона3">
                      </div>
                    </div>
                    <button class="next-btn"></button>
                  </div>
            </div>
            <h2 class="title-about-us">Наши мастера</h2>
            <div class="employee-cards">
                <div class="employee">
                    <img src="Resources/сотрудник1.jpg" alt="">
                    <div class="employee__info">
                        <div class="fio">Елена</div>
                        <div class="speciality">Парикмахер</div>
                    </div>
                </div>
                <div class="employee">
                    <img src="Resources/сотрудник2.jpg" alt="">
                    <div class="employee__info">
                        <div class="fio">Руслан</div>
                        <div class="speciality">Парикмахер</div>
                    </div>
                </div>
                <div class="employee">
                    <img src="Resources/сотрудник3.jpg" alt="">
                    <div class="employee__info">
                        <div class="fio">Альфия</div>
                        <div class="speciality">Специалист по пирсингу</div>
                    </div>
                </div>
                <div class="employee">
                    <img src="Resources/сотрудник4.jpg" alt="">
                    <div class="employee__info">
                        <div class="fio">Светлана</div>
                        <div class="speciality">Косметолог</div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("footer.php") ?>
    </body>
</html>
