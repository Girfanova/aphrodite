<style>
.select-time-radio{
display: none;
}
.select-time{
    display:inline-block;
    padding:0.5%;
    margin:1%;
    border-radius:10px;
    border:2px solid grey;
}

.select-time-radio:checked + label .select-time{
    border:2px solid red;
}
</style>
<?php 
                session_start();
                require_once("connect_db.php");
                $schedule = mysqli_query($link,"SELECT date_schedule, time_schedule, master_id,  is_busy FROM schedule  WHERE master_id = '30'");
                $date_t = mysqli_query($link,"SELECT distinct date_schedule FROM schedule");
                while ($stroka = mysqli_fetch_array($schedule)) {
                    $date[] = $stroka["date_schedule"];
                    $time[] = $stroka["time_schedule"];
                    $is_busy= $stroka["id_busy"];
                }
                while ($stroka = mysqli_fetch_array($date_t)) {
                    $date__t[] = $stroka["date_schedule"];
                }
                echo "<form>";
                foreach ($date__t as $d){
                    echo "<span>".date('d.m.Y', strtotime($d))."</span> ";
                    $time_for_this_date = mysqli_query($link,"SELECT time_schedule, is_busy FROM schedule where date_schedule='$d' and master_id=30");
                    while ($stroka = mysqli_fetch_array($time_for_this_date)) {
                        $times[] = [$stroka['time_schedule'], $stroka['is_busy']];
                    }
                    
                    foreach ($times as $t){
                        if ($t[1]==0) echo "<input type=radio class='select-time-radio' required id=".$d.$t[0]." name='select-time-radio'><label for=".$d.$t[0]."><div class='select-time'>".date('H.i', strtotime($t[0]))."</div></label>";
                       // else echo "<button disabled>".date('H:i', strtotime($t[0]))."</button> ";
                    }
                    
                    echo "<br>";
                    unset($times);
                }
                mysqli_close($link);
                echo "<input type='submit'>";
                echo "</form>";
                
                ?>