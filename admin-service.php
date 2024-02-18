<?php

$services = mysqli_query($link, 'SELECT services.id, category_id, service, price, category_name FROM services, categories where categories.id = category_id');
$count = mysqli_query($link, 'SELECT category_id, COUNT(*) as count FROM   `services` GROUP  BY `category_id`');

$services_data = [];
while ($data = mysqli_fetch_array($services)) {
	$services_data[] = [
		'id'=> $data['id'],
		'category_id' => $data['category_id'],
		'service' => $data['service'],
		'price' => $data['price'],
		'category_name' => $data['category_name']
	];
}
?>
<pre>
	<?php
	//print_r($services_data);
	?>
</pre>
<a class='add-service-btn' href='service-add.php' >Добавить услугу</a>
<?php
echo "<table border=1 width=100%>
		<tr>
		<th>Категория</th>
		<th>Название</th>
		<th width=10%>Цена</th>
		<th width=12% text-align='center'>Редактировать</th>
		<th width=8% text-align='center'>Удалить</th>
		<tr>
		";

while ($data_count = mysqli_fetch_array($count)) {

	$k = 0;
	foreach ($services_data as $service) {
		if ($data_count['category_id'] == $service['category_id']) {

			echo " 
					<tr>";
			if ($k == 0) {
				echo "<td rowspan=" . $data_count['count'] . ">" . $service['category_name'] . "</td>";
			}
			echo "
					<td>" . $service['service'] . "</td>
					<td>" . $service['price'] . " руб.</td>
					<td text-align='center'><a href='service-edit.php?service_id=".$service['id']."'><img style='display:block; margin:auto;' src='Resources\\edit.png' title='Редактировать' width=30px></a></td>
					<td text-align='center'><a href='service-delete.php?service_id=".$service['id']."'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></a></td>
					</tr>";
			$k++;
		}
	}
}

echo "</table>";
?>
<script>

</script>
