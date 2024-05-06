<?php
        if ($_SESSION["user_role"] == 3) {

            
            echo "<div class='admin-menu'>";
            
            // echo "<div class=''>Сортировать:<select id='sort-select'>
            // <option>по дате новые</option>
            // <option>по дате старые</option>
            // </select></div>";
            echo "<div class=''>Фильтровать по мастерам: <select id='filter-select' onchange='do_filter();'>";
            echo "<option value='000'>Все</option>";
            require('connect_db.php');
            $masters = mysqli_query($link,"SELECT * from masters") or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($masters)) {
                echo "<option value='".$row['id']."'>".$row['name']." ".$row['surname']."</option>";
            }
            echo "</select></div>";
            echo "<table class='record-table' id='record-table'>";
            echo "<thead>
            <tr>
                   <th>Клиент</th>
                   <th>Телефон клиента</th>
                   <th>Мастер</th>
                   <th>Услуга</th>
                   <th width=8%>Дата</th>
                   <th>Вре&shy;мя</th>
                   <th>От&shy;ме&shy;нить</th>
                   <th>Вы&shy;пол&shy;не&shy;но</th>
                   <th>Пере&shy;нести</th>
                   </tr>
                   </thead>";
                echo '<tbody id="record-list-table" width=100%>
                
                </tbody>';
                
                echo '</table>';
                echo "<span class='more-btn' id='more_btn'>+ Загрузить еще</span>";

            echo '</div>';
        }
        mysqli_close($link);
