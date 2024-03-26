<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once ("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <!-- <link rel="stylesheet" href="style-main-page.css" type="text/css"> -->
    <link rel="stylesheet" href="css/simple-adaptive-slider.css" type="text/css">
</head>
<style>
    .itcss {
        position: relative;
        max-width: none;
        width: 100%;
    }

    .about-salon .itcss__indicators {
        display: none;
    }

    .itcss__item {
        height: 450px;
    }

    .control-container-prev,
    .control-container-next {
        position: absolute;
        top: 0;
        font-size: 4em;
        color: rgb(var(--second-color-rgb));
        background-color: rgba(var(--first-color-rgb), 0.1);
        height: 100%;
        padding: 0 2%;
        display: flex;
        align-items: center;
        opacity: 0;
        transition: all ease 0.5s;
    }

    .control-container-next {
        right: 0;
    }

    #slider1:hover .control-container-next,
    #slider1:hover .control-container-prev {
        opacity: 1;
        transition: all ease 0.5s;
    }

    #slider2:hover .control-container-next,
    #slider2:hover .control-container-prev {
        opacity: 1;
        transition: all ease 0.5s;
    }

    .itcss__control {
        cursor: pointer;
    }


</style>

<body>
    <?php require_once ("header.php") ?>

    <div class="content-page">
        <div class="about-us__title">О нас</div>

        <div class="about-salon">
            <div class='about-salon__image-container'>
                <img src="Resources/aphrodite-photo.jpg" class="about-salon__image" alt="о нас">
            </div>
            <div class="about-salon__description">
                <p>
                    Название нашего салона красоты выбрано не случайно – Афродита является символом женственности,
                    красоты и
                    гармонии.<br> У нас каждый гость сможет почувствовать себя особенным и окунуться в мир роскоши и
                    профессионализма.<br>
                    Мы стремимся создавать комфортную и дружелюбную атмосферу, чтобы гости чувствовали себя уютно и
                    могли
                    насладиться процессом преображения.

                </p>
            </div>
        </div>
        <div class="about-salon">
            <div class="about-salon__description">
                <p>
                    Мы заботимся о безопасности наших мастеров и клиентов. В нашем салоне вы можете чувствовать себя
                    спокойно и безопасно с бактерицидной лампой.
                    <br><br>Бактерицидная лампа:<br>
                    <br>очищает воздух
                    <br>уничтожает полевых клещей
                    <br>уничтожает вирусы
                    <br>уничтожает бактерии
                    <br><br>Лампа в салоне находится в закрытом виде, что безопасно для использования в присутствии
                    людей.
                </p>
            </div>
            <div class='about-salon__image-container'>
                <img src="Resources/lamp.jpg" class="about-salon__image" alt="о нас">
            </div>
        </div>
        <div class="about-salon">
            <div class='about-salon-1__image-container'>
                <div class="slider-container">
                    <div class="itcss" id='slider1'>
                        <div class="itcss__wrapper">
                            <div class="itcss__items">
                                <img src='Resources/salon-photos/60-2.jpg' class='itcss__item'>
                                <img src='Resources/salon-photos/60-1.jpeg' class='itcss__item'>
                                <img src='Resources/salon-photos/60-4.jpg' class='itcss__item'>
                            </div>
                        </div>
                        <div class='control-container-prev'>
                            <div class="itcss__control itcss__control_prev" id='slider1-prev' href="" role="button"
                                data-slide="prev">
                                < </div>
                            </div>
                            <div class='control-container-next'>
                                <div class="itcss__control itcss__control_next" id='slider1-next' href="" role="button"
                                    data-slide="next">></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-salon-1__description">
                    <p>
                        Юрия Гагарина, 60
                    </p>
                </div>
            </div>
            <div class="about-salon">
                <div class="about-salon-1__description" width=30%>
                    <p>
                        Юрия Гагарина 26/2
                    </p>
                </div>
                <div class='about-salon-1__image-container' width=70%>
                    <div class="slider-container">
                        <div class="itcss" id='slider2'>
                            <div class="itcss__wrapper">
                                <div class="itcss__items">
                                    <img src='Resources/salon-photos/26-2-3.jpeg' class='itcss__item'>
                                    <img src='Resources/salon-photos/26-2-1.jpeg' class='itcss__item'>
                                    <img src='Resources/salon-photos/26-2-2.jpeg' class='itcss__item'>
                                </div>
                            </div>
                            <div class='control-container-prev'>
                                <div class="itcss__control itcss__control_prev" id='slider2-prev' href="" role="button"
                                    data-slide="prev">
                                    < </div>
                                </div>
                                <div class='control-container-next'>
                                    <div class="itcss__control itcss__control_next" id='slider2-next' href=""
                                        role="button" data-slide="next">></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-us">
                </div>
                <div class="about-us__text">
                    Наши мастера всегда готовы помочь с выбором подходящей услуги и дать
                    советы по уходу за волосами, ногтями, кожей лица и тела.
                    "Афродита" – это место, где каждый сможет почувствовать себя богиней, раскрыть свою
                    красоту и насладиться высоким качеством услуг. Мы рады видеть вас у нас и гарантируем
                    незабываемый опыт
                    преображения!
                    <br>
                    <br>
                </div>

            </div>
            <?php require_once ("footer.php") ?>
            <script src='js/simple-adaptive-slider.js'></script>
            <script>

                document.addEventListener('DOMContentLoaded', () => {
                    const slider1 = new ItcSimpleSlider('#slider1', {
                        loop: true,
                        autoplay: false,
                        interval: 5000,
                        swipe: true,
                    });
                    document.getElementById('slider1-prev').onclick = () => {
                        slider1.prev();
                    }
                    document.getElementById('slider1-next').onclick = () => {
                        slider1.next();
                    }
                    const slider2 = new ItcSimpleSlider('#slider2', {
                        loop: true,
                        autoplay: false,
                        interval: 5000,
                        swipe: true,
                    });
                    document.getElementById('slider2-prev').onclick = () => {
                        slider2.prev();
                    }
                    document.getElementById('slider2-next').onclick = () => {
                        slider2.next();
                    }
                });
            </script>
</body>

</html>