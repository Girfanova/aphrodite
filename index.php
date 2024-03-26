<!DOCTYPE html>
<html lang="ru">

<head>
<?php require_once("head.php")?>
    <link rel="stylesheet" href="style-main-page.css" type="text/css">
    <link rel="stylesheet" href="css/simple-adaptive-slider.css" type="text/css">

</head>
<style>
    .itcss__item {
        background-size: cover;
        /* border-radius: 30px; */
        margin: 0 0.5%; 
        flex: 0 0 99%;
    }
    .itcss__items{
        width: 100%;
    }
    .itcss{
        max-width:100%;
    }
    .itcss__wrapper{
        background-color: rgba(0,0,0,0);
        overflow: visible;
    }
    .discount-text-container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-flow: column wrap;
        justify-content: center;
        /* background-color: rgba(215, 201, 192, 0.5); */
        background-color: rgba(255, 255, 255, 0.5);
        align-items: center;
        /* border-radius: 30px; */
        text-align: center;
    }
</style>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>
    <div class="content">
        <div class="main_caption parallax">
            <div class="main_caption__backgr"></div>
            <div class="frame-title"></div>
            <div class="parallax__body">

                <div class="main_caption__text parallax-item">

                    <p>Салон красоты в Уфе</p>
                    <h1 class="main_caption__title">Афродита</h1>
                    <p>За красотой - к нам!</p>

                    <!--     <button class="record btn">Записаться</button>  -->
                </div>
                <img class="afr parallax-item" src="Resources/afr1.png" alt="афродита">
            </div>
        </div>
        <div class="marquee">
            <div class="marquee__inner">
                <span>стрижка</span>
                <span>укладка</span>
                <span>окрашивание</span>
                <span>маникюр</span>
                <span>педикюр</span>
                <span>уход за лицом</span>
                <span>оформление бровей и ресниц</span>
                <span>депиляция</span>
                <span>стрижка</span>
                <span>укладка</span>
                <span>окрашивание</span>
                <span>маникюр</span>
                <span>педикюр</span>
                <span>уход за лицом</span>
                <span>оформление бровей и ресниц</span>
                <span>депиляция</span>
            </div>
        </div>
        <script>

        </script>
        <div class="advantages">
            <h2 class="advantages__title">Почему мы?</h2>
            <div class="advantages__content">
                <div class="advantage">
                    <img src="Resources/coffee.svg" alt="преимущество1">
                    <div class='advantage-text'>
                        <div class='advantage-title'>Уютная гостеприимная атмосфера</div>
                        <div class='advantage-description'>У нас вы можете легко расслабиться и наслаждаться преображением.</div>
                    </div>
                </div>
                <div class="advantage">
                    <img src="Resources/full-time.svg" alt="преимущество5">
                    <div class='advantage-text'>
                    <div class='advantage-title'>Открыты 362 дня в году</div>
                    <div class='advantage-description'>Закрываемся лишь на 3 дня в новогодние праздники.<br>Время работы - с 9:00 до 21:00</div>
                </div>
                </div>
                <div class="advantage">
                    <img src="Resources/location.svg" alt="преимущество3">
                    <div class='advantage-text'>
                    <div class='advantage-title'>Удобное расположение</div>
                    <div class='advantage-description'>Находимся рядом с остановками общественного транспорта, чтобы вам было удобно добираться до нас.</div>
                </div>
                </div>
                <div class="advantage">
                    <img src="Resources/sanitaizer.svg" alt="преимущество2">
                    <div class='advantage-text'>
                    <div class='advantage-title'>Соответствие всем требованиям санитарно-эпидемиологических норм</div>
                    <div class='advantage-description'>Большое внимание уделяется обработке инструментов, поверхностей и
                        воздуха. Мастера регулярно
                        проходят медосмотр и сдают санминимум.</div>
                </div>
                </div>
                <div class="advantage">
                    <img src="Resources/reliability.svg" alt="преимущество4">
                    <div class='advantage-text'>
                    <div class='advantage-title'>У нас работают надежные специалисты</div>
                    <div class='advantage-description'>Наши мастера с большим стажем работы, владеющие самыми
                        разнообразными современными техниками в
                        парикмахерском искусстве, косметологии и области маникюра.</div>
                </div>
                </div>
            </div>

        </div>
        <div class="discount">
            <!-- <a class="discount__more" href="promotions.php">Все акции<span class="arrow"><span></span></span></a> -->

            <div class="discount__rectangle">
                <!-- <div class="discount__content"> -->
                    <div class="itcss" style='height:100%;'>
                        <div class="itcss__wrapper" style='height:100%;'>
                            <div class="itcss__items" style='height:100%;'>
                                <?php
                                require_once("connect_db.php");
                                $promotions = mysqli_query($link, "SELECT * FROM promotions");
                                while ($row = mysqli_fetch_assoc($promotions)) {
                                    $path = "Resources/promotions/" . $row['picture']."";
                                    // echo "<script>console.log($path);</script>";
                                    echo "<div style='background-image:url(" . $path . "); ' class='itcss__item'>
                                <div class='discount-text-container'>
                                <div class='discount__text1'>" . $row['title'] . "</div>
                                <div class='discount__text2'>" . $row['description'] . "</div>
                                </div>
                            </div>";
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                        <a class="itcss__control itcss__control_prev" href="#" role="button" data-slide="prev"></a>
                        <a class="itcss__control itcss__control_next" href="#" role="button" data-slide="next"></a>
                    </div>
                    <!-- <div class="discount-container">
                        <div class="discount__amount">-10%</div>
                        <div class="discount__text1">Скидка на первое посещение!</div>
                        <div class="discount__text2">Авторизуйтесь, чтобы воспользоваться предложением</div>
                        <?php
                        // session_start();
                        // if ($_SESSION['auth'] == true)
                        //     echo "<button class='authorization_btn' disabled >Вы уже авторизованы</button>";
                        // else
                        //     echo " <button class='authorization_btn btn'>Авторизоваться</button>";
                        ?>

                    </div> -->
                <!-- </div> -->
                <!-- <div class="discount__content">
                    <div class="possibilities">
                        <div class="possibilities-title">После авторизации вам будут доступны:</div>
                        <div class='pos'><img src='Resources/add.png'><span class="pos1">Онлайн-запись</span></div>
                        <div class='pos'><img src='Resources/account.png'><span class="pos2">Личный кабинет</span></div>
                        <div class='pos'><img src='Resources/history.png'><span class="pos3">История посещений</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="services">
            <h2 class="services__title">Наши услуги</h2>
            <div class="services__list">
                <div class="service">
                    <a href="hairdressing.php"><img src="Resources/hair.jpg"
                            alt="парикмахерские услуги"></a>
                    <div class="service__description">Парикмахерские услуги</div>
                </div>
                <div class="service">
                    <a href="nail-service.php"><img src="Resources/nail.jpg" alt="ногтевой сервис"></a>
                    <div class="service__description">Ногтевой сервис</div>
                </div>
                <div class="service">
                    <a href="eyelashes-and-eyebrows.php"> <img src="Resources/brow.jpg"
                            alt="брови-ресницы"></a>
                    <div class="service__description">Ресницы и брови</div>
                </div>
                <div class="service">
                    <a href="cosmetology.php"> <img src="Resources/mask.jpg" alt="косметология"></a>
                    <div class="service__description">Косметология</div>
                </div>
                <div class="service">
                    <a href="depilation-waxing.php"> <img src="Resources/depilation.jpg" alt="депиляция/воск"></a>
                    <div class="service__description">Депиляция/воск</div>
                </div>
            </div>
        </div>

        <!-- <div class="about-salon"> -->
            <!-- <h2 class="about-salon__title">Наша цель</h2> -->
            <!-- <div class='greek-top'></div> -->
            <!-- <div class='greek-bottom'></div> -->
            <!-- <div class="container">
                <div class='about-salon__image-container'> -->
                    <!-- <div class='greek-left'></div> -->
                    <!-- <div class='greek-right'></div> -->

                    <!-- <img src="Resources/aphrodite-photo.jpg" class="about-salon__image" alt="о нас">
                </div>
                <div class="about-salon__description">
                    <p>
                        <span class="first-letter">Наша цель</span> - дарить красоту и придавать уверенность своим клиентам. У нас каждый сможет почувствовать себя богиней. 
                        <br><br>Приходите и убедитесь в этом сами!
                    </p> -->

                    <!-- <p>Наш салон красоты - это целый мир, в котором Вы можете провести время с комфортом в дали от
                        повседневной деятельности.
                        В этом Вам помогут наш обходительный и вежливый персонал, располагающая обстановка и
                        расслабляющая, мелодичная музыка.
                        У нас Вы сможете отвлечься от проблем и будничной суеты.<br><br>
                        Мы ценим каждого нашего клиента. Основная цель нашей работы - это безостановочное стремление к
                        идеалу. Вашему идеалу.
                        Для нас по-настоящему важно, чтобы клиенты не сомневались в нашей компетентности, поэтому мы
                        предлагаем только лучшее.</p> -->
                    <!-- </div>
                    
                </div>
            </div> -->

        <div class="reviews">
            <h2 class="reviews__title">Что о нас говорят</h2>
            <div class="container">
                <div class="reviews__content">
                    <div class="review">
                        <div class="review__text">Стригусь уже здесь почти год и за всё время, которое я ходил сюда,
                            могу сказать, что это лучшая парикмахерская, в которой я был, всё очень классно. Коллектив
                            отличный, вежливый, особенно могу выделить Руслана (именно к нему и хожу), просто суперский
                            парикмахер, отлично сделает стрижку, так ещё и может подсказать разные другие варианты
                            стрижек, которые могут вам подойти. Так же Руслан хороший собеседник, с ним можно поговорить
                            почти на все темы, если не на все, конечно. В общем всем советую стричься именно в данной
                            парикмахерской, лучше не видел.</div>
                        <div class="review__author">- Вадим</div>
                    </div>
                    <div class="review">
                        <div class="review__text">Посетила данный салон, осталась очень довольна работой специалиста по
                            пирсингу Альфии. Очень внимательный и вежливый подход к клиенту, ответила на все вопросы,
                            дала рекомендации по уходу за проколами, работа выполнена качественно, с учётом всех
                            пожеланий клиента👍🏽</div>
                        <div class="review__author">- Регина</div>
                    </div>
                    <div class="review">
                        <div class="review__text">Ходила в массажный салон к Светлане на ручной и аппаратный массаж.
                            Удобное место расположения, у нее комфортно и уютно. Светлана настоящий мастер своего дела.
                            Я очень довольна результатом. Кожа на лице заметно посвежела и разгладилась, овал лица стал
                            более четкий. Убрали целлюлит, ноги стали более подтянутые и стройные. Советую массаж тем, у
                            кого есть боли в спине. Превосходный результат! Всем рекомендую этот салон.</div>
                        <div class="review__author">- Лейсан</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("footer.php") ?>
    <script src='js/simple-adaptive-slider.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // инициализация слайдера
            new ItcSimpleSlider('.itcss', {
                loop: true,
                autoplay: true,
                interval: 5000,
                swipe: true,
            });
        });
    </script>

</body>

</html>