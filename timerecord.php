<?php   function getrecordtimes(){ 
                    $times=null;
                    $time_for_this_date = mysqli_query($link,"SELECT time_schedule, is_busy FROM schedule where date_schedule=".$_GET['date-record']." and master_id=$master_id");
                    while ($stroka = mysqli_fetch_array($time_for_this_date)) {
                        $times[] = [$stroka['time_schedule'], $stroka['is_busy']];
                    }
                    
                    //foreach ($times as $t){
                     //   if ($t[1]==0) echo "<input type=radio class='select-time-radio' required id=".$d.$t[0]." name='select-time-radio'><label for=".$d.$t[0]."><div class='select-time'>".date('H.i', strtotime($t[0]))."</div></label>";
                       // else echo "<button disabled>".date('H:i', strtotime($t[0]))."</button> ";
                  //  }
                    echo $times;
                }
?>
                    