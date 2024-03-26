<?php

require_once("service-add-popup.php");
require_once('connect_db.php');
$services = mysqli_query($link, 'SELECT services.id, category_id, service, price, category_name, duration_in_min, is_recording FROM services, categories where categories.id = category_id');
$count = mysqli_query($link, 'SELECT category_id, COUNT(*) as count FROM   `services` GROUP  BY `category_id`');

$services_data = [];
while ($data = mysqli_fetch_array($services)) {
	$services_data[] = [
		'id' => $data['id'],
		'category_id' => $data['category_id'],
		'service' => $data['service'],
		'price' => $data['price'],
		'category_name' => $data['category_name'],
		'duration' => $data['duration_in_min'],
		'is_recording' => $data['is_recording'],
	];
}
?>

<div class='add-service-btn' onclick='service_add();'>Добавить услугу</div>
<?php
echo "<table border=1 width=100%>
		<tr>
		<th>Кате&shyгория</th>
		<th>Наз&shyвание</th>
		<th>Цена</th>
		<th>За&shyпись</th>
		<th>Дли&shyтель&shyность</th>
		<th>Ре&shyдак&shyтиро&shyвать</th>
		<th>Уда&shyлить</th>
		</tr>
		";

while ($data_count = mysqli_fetch_array($count)) {

	$k = 0;
	foreach ($services_data as $service) {
		if ($data_count['category_id'] == $service['category_id']) {

			echo " 
					<tr id='admin-service".$service['id']."' >";
			if ($k == 0) {
				echo "<td id='admin-category-service".$service['category_id']."' style=' word-break: break-all;' rowspan=" . $data_count['count'] . ">" . $service['category_name'] . "</td>";
			}
			echo "
					<td style=' word-break: break-all;'>" . $service['service'] . "</td>
					<td>" . $service['price'] . " руб.</td>";
			if ($service['is_recording']) {
				echo "<td>Есть</td><td>" . $service['duration'] . " мин</td>";
			} else {
				echo "<td>Нет</td	><td>-</td	>";
			}
			//	echo"	<td text-align='center'><a href='service-edit.php?service_id=".$service['id']."'><img style='display:block; margin:auto;' src='Resources/edit.png' title='Редактировать' width=30px></a></td>
			echo "<td text-align='center'><img onclick=service_edit(" . $service['id'] . "); style='display:block; margin:auto;' src='Resources/edit.png' title='Редактировать' width=30px></td>
					<td text-align='center'><img onclick=service_delete(" . $service['id'] . "," .$service['category_id']."); style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></td>
					</tr>";
			$k++;
		}
	}
}

echo "</table>";
?>
<script>
	function service_edit(id) {
		$.ajax({
			url: 'service-edit-popup.php',
			method: 'get',
			async: false,
			dataType: 'html',
			data: { service_id: id },
			success: function (data) {
				$('#popup').html(data);
				var popup_service_edit = document.querySelector(".popup-service-edit");
				var close_serv = document.getElementById("close-service-edit-btn");
				popup_service_edit.classList.toggle("popup_open");
				document.body.style.overflow = "hidden";
				close_serv.addEventListener("click", function () {
					popup_service_edit.classList.remove("popup_open");
					document.body.style.overflow = "visible";
				})
			}
		});
	}
	function service_add() {
		var popup_service_edit = document.querySelector(".popup-service-add");
		var close_serv = document.getElementById("close-service-add-btn");
		popup_service_edit.classList.toggle("popup_open");
		document.body.style.overflow = "hidden";
		close_serv.addEventListener("click", function () {
			popup_service_edit.classList.remove("popup_open");
			document.body.style.overflow = "visible";
		})
	}

</script>