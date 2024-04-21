<?php
require("connect_db.php");
$promotions = mysqli_query($link, 'SELECT * FROM promotions');
?>
<div class='add-service-btn' onclick='promotion_add();'>Добавить акцию</div>
<?php
echo "<table id='admin-promotions' class='admin-table'>
		<tr>
		<th>Заголовок</th>
		<th>Описание</th>
		<th>Картинка</th>
		<th>Ре&shyдак&shyтиро&shyвать</th>
		<th>Уда&shyлить</th>
		</tr>
		";

while ($data = mysqli_fetch_array($promotions)) {

	echo " <tr id='admin-promotion".$data['id']."'>
					<td class='promotion-table-title'>" . $data['title'] . "</td>
					<td class='promotion-table-description'>" . $data['description'] . "</td>";
	if ($data["picture"]) {
		echo "
					<td><a href='Resources/promotions/" . $data['picture'] . "'><img class='promotion-table-img' src='Resources/promotions/" . $data['picture'] . "'></a></td>";
	} else {
		echo "<td align=center>-</td>";
	}
	echo "<td text-align='center'><img style='display:block; margin:auto;' src='Resources\\edit.png' title='Редактировать' width=30px onclick=promotion_edit(" . $data['id'] . ");></a></td>";
	echo "<td text-align='center'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px onclick=promotion_delete(" . $data['id'] . ");></td>
					</tr>";
	$k++;

}

echo "</table>";
mysqli_close($link);
?>