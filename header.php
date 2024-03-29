<?php session_start(); ?><header class="header" id="header">
        <div class="container ">
            <div class="logo"><a href="/"> <img src="Resources/логотип11-черный.png" id="logo" alt="логотип"></a></div>
            <nav id="menu">
                <ul class="menu_list">
                    <li>
                        <a class="menu_link" id="op_menu_sub-list">Услуги</a>
                        <ul class="menu_sub-list">
                            <li><a href="hairdressing.php" class="menu_sub-link">Парикмахерские услуги</a></li>
                            <li><a href="nail-service.php" class="menu_sub-link">Ногтевой сервис</a></li>
                            <li><a href="eyelashes-and-eyebrows.php" class="menu_sub-link">Ресницы и брови</a></li>
                            <li><a href="cosmetology.php" class="menu_sub-link">Косметология</a></li>
                            <li><a href="depilation-waxing.php" class="menu_sub-link">Депиляция/воск</a></li>
                        </ul>
                    </li>
                    <li><a href="about-us.php" class="menu_link">О нас</a></li>
                    <li><a href="portfolio.php" class="menu_link">Портфолио</a></li>
                    <!--<li><a href="promotions.php" class="menu_link">Акции</a></li>-->
                    
                </ul>
                <?php
                
                if (isset($_SESSION["auth"])) 
                echo "<button onclick=\"window.location.href = 'lk.php'\" class='header_lk_btn btn'>Личный кабинет</button>";
                else echo '<button class="header_authorization_btn btn popup_autor">Войти/Авторизоваться</button>';
                ?>

            </nav>
            <div id="menu-burg" class='black-menu-burg'><span></span></div>
            <?php
                if (isset($_SESSION["auth"])) {
                    require_once("connect_db.php");
                    mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
                    $query = "SELECT name FROM users WHERE id = ".$_SESSION['user_id'];
                    $result = mysqli_query($link, $query);
                    $user =  mysqli_fetch_array($result);
                    
                    echo " <a class='lk-open' href='lk.php'><div class='profile-circle' id = \"auth_circle\" class=\"popup_autor\" 
                    style='width:35px; height:35px;font-size:1.5em; color:black; background-color:rgba(0,0,0,0); border:solid;'>".mb_substr($user['name'], 0, 1)."</div></a>";
                }
                else echo "<div class=\"authorization\"><img src=\"Resources/авторизация-black.png\" id = \"auth\" class=\"popup_autor\" alt=\"авторизация\"
                width=\"30\"></div>";
                
            ?>
           
            
        </div>
    </header>