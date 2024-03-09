<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once("head.php") ?>
    <link rel="stylesheet" href="style-pages.css" type="text/css">
    <link rel="stylesheet" href="css/simple-adaptive-slider.css" type="text/css">
</head>
<style>
   
    .slider-container{
        width:40%;
        margin: 2%;
    }
    .itcss__control {
        width: 100px;
    }
    
    .itcss {
      
    }

    .itcss__item img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .slider-title{
        background-color: var(--third-color);
        padding: 2%;
        margin: 2% 0;
        height: 5%;
        font-size: 1.4em;
    }
</style>

<body>
    <?php require_once("header.php") ?>
    <?php require_once("auth.php") ?>

    <div class="content-page">
    <div class="about-us__title">О нас</div>
        <div class="about-us">
            <div class="slider-container">
                <div class="itcss" id='slider1'>
                    <div class="itcss__wrapper">
                        <div class="itcss__items">
                            <img src='Resources/salon-photos/60-2.jpg' class='itcss__item'>
                            <img src='Resources/salon-photos/60-1.jpeg' class='itcss__item'>
                            <img src='Resources/salon-photos/60-4.jpg' class='itcss__item'>
                        </div>
                    </div>
                    <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                    <a class="itcss__control itcss__control_prev" id='slider1-prev' href="#" role="button"
                        data-slide="prev">
                    </a>
                    <a class="itcss__control itcss__control_next" id='slider1-next' href="#" role="button"
                        data-slide="next"></a>
                </div>
                <div class="slider-title">Юрия Гагарина 60</div>
            </div>
            <div class="about-us__text">
                
                <span class="first-word">Салон красоты "Афродита" </span> — это целый мир, в котором Вы можете провести
                время с комфортом в дали от повседневной деятельности.
                В этом Вам помогут наш обходительный и вежливый персонал, располагающая обстановка и расслабляющая,
                мелодичная музыка.
                У нас Вы сможете отвлечься от проблем и будничной суеты.<br><br>
                Мы ценим каждого нашего клиента. Основная цель нашей работы - это безостановочное стремление к идеалу.
                Вашему идеалу.
                Для нас по-настоящему важно, чтобы клиенты не сомневались в нашей компетентности, поэтому мы предлагаем
                только лучшее.
                Салоны разделены на несколько зон: парикмахерская, зона ногтевого сервиса и косметологический кабинет.
            </div>
            <div class="slider-container">
                <div class="itcss" id='slider2'>
                    <div class="itcss__wrapper">
                        <div class="itcss__items">
                            <img src='Resources/salon-photos/26-2-3.jpeg' class='itcss__item'>
                            <img src='Resources/salon-photos/26-2-1.jpeg' class='itcss__item'>
                            <img src='Resources/salon-photos/26-2-2.jpeg' class='itcss__item'>
                        </div>
                    </div>
                    <!-- Стрелки для перехода к предыдущему и следующему слайду -->
                    <a class="itcss__control itcss__control_prev" href="#" role="button" data-slide="prev"></a>
                    <a class="itcss__control itcss__control_next" href="#" role="button" data-slide="next"></a>
                </div>
                <div class="slider-title">Юрия Гагарина 26/2</div>
            </div>
            <!-- <div class="slider"> 
                    <button class="prew-btn"></button>
                    <div class="slider__wrapper">
                      <div class="slider__items">
                            <img src="Resources/slider1.jpg" class="slider__item" alt="Фото салона1">
                            <img src="Resources/slider2.jpg" class="slider__item" alt="Фото салона2">
                            <img src="Resources/slider3.jpg" class="slider__item" alt="Фото салона3">
                      </div>
                    </div>
                    <button class="next-btn"></button>
                  </div> -->
        </div>
        <!-- <h2 class="title-about-us">Наши мастера</h2>
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
        </div> -->
    </div>
    <?php require_once("footer.php") ?>
    <script src='js/simple-adaptive-slider.js'></script>
    <script>
        //     document.querySelector('.itcss__control_prev').onclick = function () {
        //     // перейдём к предыдущему слайду
        //     slider.prev();
        //   }
        //   // назначим обработчик при нажатии на кнопку .btn-next
        //   document.querySelector('.itcss__control_next').onclick = function () {
        //     // перейдём к следующему слайду
        //     slider.next();
        //   }
        document.addEventListener('DOMContentLoaded', () => {
            new ItcSimpleSlider('#slider1', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
            });
            new ItcSimpleSlider('#slider2', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
            });
        });
    </script>
</body>

</html>