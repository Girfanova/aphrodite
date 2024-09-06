<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.html") ?>
    <link rel="stylesheet" href="css/simple-adaptive-slider.css" type="text/css">
    <link rel="stylesheet" href="css/style-main-page.css" type="text/css">

</head>
<style>
    .control-container-next,
    .control-container-prev {
        position: absolute;
        top: 0;
        font-size: 4rem;
        font-weight: lighter;
        color: rgb(var(--second-color-rgb));
        width: 4vw;
        height: 100%;
        display: flex;
        align-items: center;
        opacity: 0;
        transition: all ease 0.5s;
    }

    .control-container-next {
        right: 0;
    }

    .control-container-prev {
        left: 0;
    }

    .discount__rectangle:hover .control-container-next,
    .discount__rectangle:hover .control-container-prev {
        opacity: 1;
        transition: all ease 0.5s;

    }
    .reviews .container{
        position: relative;
    }
    .reviews .container:hover .control-container-next,
    .reviews .container:hover .control-container-prev {
        opacity: 1;
        transition: all ease 0.5s;

    }

    .itcss__control {
        cursor: pointer;
        width: 100%;
        text-align: center;
        /* text-shadow: 0px 0px 2px rgb(var(--first-color-rgb)); */
        background-color: rgba(var(--first-color-rgb), 0.3);
        /* background-color: var(--third-color); */
        padding: 0;
    }

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

    .itcss2 {
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
                <img class="afr parallax-item" src="Resources/afr2-min.png" alt="афродита">
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
                </div>
                <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                <div class='control-container-prev'>
                    <div class="itcss__control itcss__control_prev" id='slider3-prev' href="" role="button"
                        data-slide="prev">
                        &#8249;</div>
                </div>
                <div class='control-container-next'>
                    <div class="itcss__control itcss__control_next" id='slider3-next' href="" role="button"
                        data-slide="next">&#8250;</div>
                </div>
            </div>
            
        </div>
        <div class="possibilities-container">
            <img src="Resources/possibility-photo.jpg" alt="" class="possibilities-photo">
                    <div class="possibilities">
                        <div class="possibilities-title">Онлайн-запись</div>
                        <div>Записаться на услугу к мастеру просто и удобно! <br>
                        <a href="javascript:void(0);" 
                        <?php 
                        session_start(); 
                        if(!isset($_SESSION['auth'])) echo 'onclick="openPopup();"'; 
                        else echo 'onclick="alert(\'Вы уже авторизованы\');"'; 
                        ?>>
                        Авторизуйтесь</a> или <a href="javascript:void(0);"
                        <?php 
                        session_start(); 
                        if(!isset($_SESSION['auth'])) echo 'onclick="openRegPopup();"'; 
                        else echo 'onclick="alert(\'Вы уже авторизованы\');"'; 
                        ?>> 
                        зарегистрируйтесь</a> для записи и доступа к личному кабинету.</div>
                        
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
                </div>
                <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                <div class='control-container-prev'>
                    <div class="itcss__control itcss__control_prev" id='slider4-prev' href="" role="button"
                        data-slide="prev">
                        &#8249;</div>
                </div>
                <div class='control-container-next'>
                    <div class="itcss__control itcss__control_next" id='slider4-next' href="" role="button"
                        data-slide="next">&#8250;</div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once ("footer.html") ?>
    <script src='js/simple-adaptive-slider.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // инициализация слайдера акций
            const slider3 = new ItcSimpleSlider('.itcss1', {
                loop: true,
                autoplay: true,
                interval: 5000,
                swipe: true,
            });
            document.getElementById('slider3-prev').onclick = () => {
                slider3.prev();
            }
            document.getElementById('slider3-next').onclick = () => {
                slider3.next();
            }
            // инициализация слайдера отзывов
            const slider4 = new ItcSimpleSlider('.itcss2', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
            });
            document.getElementById('slider4-prev').onclick = () => {
                slider4.prev();
            }
            document.getElementById('slider4-next').onclick = () => {
                slider4.next();
            }
        });
    </script>

</body>

</html>