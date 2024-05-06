<?php
require_once ("connect_db.php");
if (isset($_POST["id"])) {
    $record_id = $_POST['id'];
    $records = mysqli_query($link, "SELECT master_id, concat (users.name,' ', users.surname) as user_name, concat (masters.name,' ', masters.surname) as master_name, date_record, time_record, specialization_id, records.id, services.service, services.id as service_id FROM records, users, masters, services where records.service_id=services.id and records.id= $record_id and user_id=users.id and master_id = masters.id");
    $rec = mysqli_fetch_assoc($records);
    $masters = mysqli_query($link, "SELECT concat (masters.name,' ', masters.surname) as master_name, id FROM masters where specialization_id =".$rec['specialization_id']." and id<>".$rec['master_id']);
    $master = mysqli_fetch_assoc($masters);
}
mysqli_close($link);
echo json_encode(array ($rec, $master));
