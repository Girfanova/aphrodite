<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.php") ?>
    <link rel="stylesheet" href="css/simple-adaptive-slider.css" type="text/css">
    <link rel="stylesheet" href="style-main-page.css" type="text/css">

</head>
<style>
    .itcss__item1 {
        background-size: cover;
        /* border-radius: 30px; */
        margin: 0 0.5%;
        flex: 0 0 99%;
    }

    .itcss__items1 {
        width: 100%;
    }

    .itcss1 {
        max-width: 100%;
    }
    .itcss2{
        padding: 3% 0;
    }
    .itcss__wrapper {
        background-color: rgba(0, 0, 0, 0);
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
    <?php require_once ("header.php") ?>
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
                <img class="afr parallax-item" src="Resources/afr2.png" alt="афродита">
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
                        <div class='advantage-description'>У нас вы можете легко расслабиться и наслаждаться
                            преображением.</div>
                    </div>
                </div>
                <div class="advantage">
                    <img src="Resources/full-time.svg" alt="преимущество5">
                    <div class='advantage-text'>
                        <div class='advantage-title'>Открыты 362 дня в году</div>
                        <div class='advantage-description'>Закрываемся лишь на 3 дня в новогодние праздники.<br>Время
                            работы - с 9:00 до 21:00</div>
                    </div>
                </div>
                <div class="advantage">
                    <img src="Resources/location.svg" alt="преимущество3">
                    <div class='advantage-text'>
                        <div class='advantage-title'>Удобное расположение</div>
                        <div class='advantage-description'>Находимся рядом с остановками общественного транспорта, чтобы
                            вам было удобно добираться до нас.</div>
                    </div>
                </div>
                <div class="advantage">
                    <img src="Resources/sanitaizer.svg" alt="преимущество2">
                    <div class='advantage-text'>
                        <div class='advantage-title'>Соответствие всем требованиям санитарно-эпидемиологических норм
                        </div>
                        <div class='advantage-description'>Большое внимание уделяется обработке инструментов,
                            поверхностей и
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
                <div class="itcss itcss1" style='height:100%;'>
                    <div class="itcss__wrapper itcss__wrapper1" style='height:100%;'>
                        <div class="itcss__items itcss__items1" style='height:100%;'>
                            <?php
                            require ("connect_db.php");
                            $promotions = mysqli_query($link, "SELECT * FROM promotions");
                            while ($row = mysqli_fetch_assoc($promotions)) {
                                $path = "Resources/promotions/" . $row['picture'] . "";
                                // echo "<script>console.log($path);</script>";
                                echo "<div style='background-image:url(" . $path . "); ' class='itcss__item itcss__item1'>
                                <div class='discount-text-container'>
                                <div class='discount__text1'>" . $row['title'] . "</div>
                                <div class='discount__text2'>" . $row['description'] . "</div>
                                </div>
                            </div>";
                            }
                            mysqli_close($link);
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
                    <a href="hairdressing.php"><img src="Resources/hair.jpg" alt="парикмахерские услуги"></a>
                    <div class="service__description">Парикмахерские услуги</div>
                </div>
                <div class="service">
                    <a href="nail-service.php"><img src="Resources/nail.jpg" alt="ногтевой сервис"></a>
                    <div class="service__description">Ногтевой сервис</div>
                </div>
                <div class="service">
                    <a href="eyelashes-and-eyebrows.php"> <img src="Resources/brow.jpg" alt="брови-ресницы"></a>
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
            <div class="itcss itcss2">
                        <div class="itcss__wrapper">
                            <div class="itcss__items">
                                <?php
                                require ("connect_db.php");
                                $reviews = mysqli_query($link, "SELECT * FROM reviews");
                                while ($row = mysqli_fetch_assoc($reviews)) {
                                    echo "<div class='itcss__item'>
                                <div class='review'>
                                <div class='review__author'>" . $row['name'] . "
                                <!--<span class='review__author-status'> &#8212; посетитель</span>-->   
                                </div>
                                
                                <p class='review__text'><span class='quotes'>&#10077;</span> " . $row['content'] . " <span class='quotes'>&#10078;</span></p>
                                
                                <div class='review__date'>" . date_format(date_create($row['date']), 'd.m.Y') . "</div>
                                </div>
                            </div>";
                                }
                                mysqli_close($link);
                                ?>
                            </div>
                        </div>
                        <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                        <a class="itcss__control itcss__control_prev" href="#" role="button" data-slide="prev"></a>
                        <a class="itcss__control itcss__control_next" href="#" role="button" data-slide="next"></a>
                    </div>
            </div>
        </div>
    </div>
    <?php require_once ("footer.php") ?>
    <script src='js/simple-adaptive-slider.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // инициализация 1 слайдера
            new ItcSimpleSlider('.itcss1', {
                loop: true,
                autoplay: true,
                interval: 5000,
                swipe: true,
            });
            // инициализация 2 слайдера
            new ItcSimpleSlider('.itcss2', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
            });
        });
    </script>

</body>

</html>