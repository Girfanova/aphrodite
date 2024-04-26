
    <?php
    require("connect_db.php");
    $masters = mysqli_query($link, 'SELECT * FROM masters');
    ?>
    <div class="masters-container admin-menu">

        <div class="masters-list" id='masters-list'>
            <!-- <select id="master-list" onchange="show_master_schedule(this);"> -->
                <?php
                $k = 0;
                while ($row = mysqli_fetch_array($masters)) {
                    if ($k == 0) {
                        $k = 1;
                        $first_m = $row['id'];
                        echo "<input type='radio' name='selected-master' id='master".$row['id']."' value=" . $row['id'] . " onchange='show_master_schedule();' checked class='master'>";
                        echo "<label for='master".$row['id']."'>".$row['name']." ".$row['surname']."</label>";
                        // echo "<option value=" . $row['id'] . " class='master' selected>" . $row['name'] . " " . $row['surname'] . "</option>";
                    } else{
                        echo "<input type='radio' name='selected-master' id='master".$row['id']."' value=" . $row['id'] . " onchange='show_master_schedule();' class='master'>";
                        echo "<label for='master".$row['id']."'>".$row['name']." ".$row['surname']."</label>";
                        // echo "<option value=" . $row['id'] . " class='master'>" . $row['name'] . " " . $row['surname'] . "</option>";
                    }
                }
                mysqli_close($link);
                ?>
        </div>
        <div class="schedule-list">
            <form id='form-schedule' onsubmit='return false;' method='post'>
                <div id='schedule-master'></div>
                <input type="submit" value="Сохранить" class="form-submit-btn btn">
            </form>
        </div>
    </div>
    