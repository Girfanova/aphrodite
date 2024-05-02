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
                   <th width=14%>Клиент</th>
                   <th width=15%>Телефон клиента</th>
                   <th width=14%>Мастер</th>
                   <th width=22%>Услуга</th>
                   <th width=10%>Дата</th>
                   <th width=7%>Время</th>
                   <th width=9%>Отменить</th>
                   <th width=9%>Выполнено</th>
                   </tr>
                   </thead>";
                echo '<tbody id="record-list-table" width=100%>
                
                </tbody>';
                
                echo '</table>';
                echo "<span class='more-btn' id='more_btn'>+ Загрузить еще</span>";

            echo '</div>';
        }
        mysqli_close($link);
