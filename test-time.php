<?php 
function StartTimer ($what='') {
global $MYTIMER; $MYTIMER=0; //global variable to store time
//if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') return; //only show for my IP address

echo '<p style="border:1px solid black; color: black; background: yellow;">';
echo "About to run <i>$what</i>. "; flush(); //output this to the browser
//$MYTIMER = microtime (true); //in PHP5 you need only this line to get the time

list ($usec, $sec) = explode (' ', microtime());
$MYTIMER = ((float) $usec + (float) $sec); //set the timer
}
function StopTimer() {
global $MYTIMER; if (!$MYTIMER) return; //no timer has been started
list ($usec, $sec) = explode (' ', microtime()); //get the current time
$MYTIMER = ((float) $usec + (float) $sec) - $MYTIMER; //the time taken in milliseconds
echo 'Took ' . number_format ($MYTIMER, 4) . ' seconds.</p>'; flush();
}