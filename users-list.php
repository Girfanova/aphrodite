<?php 
            require_once('connect_db.php');     
            if (isset($_GET['search']) and $_GET['search']!='') $users = mysqli_query($link,"SELECT users.id, surname, name, role_name, phone, role_id FROM users, roles WHERE users.role_id = roles.id and (surname LIKE '".$_GET['search']."%' or name LIKE '".$_GET['search']."%' or role_name LIKE '".$_GET['search']."%' or phone LIKE '".$_GET['search']."%') ORDER BY users.id");
            else $users = mysqli_query($link,"SELECT users.id, surname, name, role_name, role_id, phone FROM users, roles WHERE users.role_id = roles.id ORDER BY users.id");
            echo '<center><table border=1 width=100%>
            <tr>
            <th>Пользователь</th>
            <th>Телефон</th>
            <th>Роль</th>
            </tr>';
            while ($stroka = mysqli_fetch_array($users)) {
                if ($stroka['role_id']=='10') continue;
            echo "<tr>";
            echo "<td> {$stroka['surname']} {$stroka['name']}</td>";
            echo "<td> {$stroka['phone']}</td>";
            // echo "<td> {$stroka['role_name']} </td>";
            // echo "<td><a href='delete-user.php?id=".$stroka['id']."'>Удалить</a></td>";
            echo "<td>
                <select id='select_user_role".$stroka['id']."' style='width:100%' onchange='change_role(this,{$stroka['id']});'>";
                   if ($stroka['role_id']=='1') echo "<option value=0>{$stroka['role_name']}</option>
                    <option value='3'>Сделать администратором салона</option>
                    <option value = '2'>Сделать мастером</option>";
                   if ($stroka['role_id']=='2') echo "<option value=0>{$stroka['role_name']}</option>
                   <option value='1'>Сделать клиентом</option>
                    <option value='3'>Сделать администратором салона</option>";
                   if ($stroka['role_id']=='3') echo "<option value=0>{$stroka['role_name']}</option>
                   <option value='1'>Сделать клиентом</option>
                    <option value='2'>Сделать мастером</option>";
            echo    "</select>
            </td>";
            // if ($stroka['role_id'] == '10') echo "<td><a href='edit-user.php?id=".$stroka['id']."&role_id=".$stroka['role_id']."'>Сделать его пользователем</a></td>";
            // else echo "<td><a href='edit-user.php?id=".$stroka['id']."&role_id=".$stroka['role_id']."'>Сделать его администратором</a></td>";
            echo "</tr>";
            }
            if(mysqli_num_rows($users)==0) echo '<td colspan=3>Нет пользователей</td>';
            echo '</table></center>';