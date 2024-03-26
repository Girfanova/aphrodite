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
                </ul>
                <?php
                if ($_SESSION["auth"]==true) 
                echo "<button onclick=\"window.location.href = 'admin.php'\" class='header_lk_btn btn'>Админ-панель</button>";
                ?>

            </nav>
            <div id="menu-burg" class='black-menu-burg'><span></span></div>
            <?php
                if ($_SESSION["auth"]==true) {                    
                    echo " <a class='lk-open' href='admin.php'><div class='profile-circle' id = \"auth_circle\" class=\"popup_autor\" 
                    style='width:35px; height:35px;font-size:1.5em; color:black; background-color:rgba(0,0,0,0); border:solid;'>А</div></a>";
                }
                
            ?>
           
            
        </div>
    </header>