<?php
require_once("connect_db.php");
$promotions = mysqli_query($link, 'SELECT * FROM promotions');
echo "<script>console.log(11111);</script>";
?>
<pre>
	<?php
	//print_r($services_data);
	?>
</pre>
<a class='add-service-btn' href='promotion-add.php'>Добавить акцию</a>
<?php
echo "<table border=1 width=100%>
		<tr>
		<th>Заголовок</th>
		<th>Описание</th>
		<th>Картинка</th>
		<th width=12% text-align='center'>Редактировать</th>
		<th width=8% text-align='center'>Удалить</th>
		<tr>
		";

while ($data = mysqli_fetch_array($promotions)) {

	echo "
					<td>" . $data['title'] . "</td>
					<td>" . $data['description'] . "</td>";
	if ($data["picture"]) {
		echo "
					<td><img style='display:block; margin:auto;' width=200px src='Resources/promotions/" . $data['picture'] . "'></td>";
	} else {
		echo "<td align=center>-</td>";
	}
	echo "<td text-align='center'><a href='promotion-edit.php?promotion_id=" . $data['id'] . "'><img style='display:block; margin:auto;' src='Resources\\edit.png' title='Редактировать' width=30px></a></td>";
	// <td text-align='center'><a href='promotion-delete.php?promotion_id=".$data['id']."'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></a></td>
	echo "<td text-align='center'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px onclick=promotion_delete(" . $data['id'] . ");></td>
					</tr>";
	$k++;

}

echo "</table>";
?>
<script>
	function promotion_obnov(id) {
		$.ajax({
			url: '/promotion-delete.php',         /* Куда отправить запрос */
			method: 'get',             /* Метод запроса (post или get) */
			dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
			data: { promotion_id: id },     /* Данные передаваемые в массиве */
			success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
				console.log(data); /* В переменной data содержится ответ от index.php. */
			}
		});
        $.ajax({
                url: "admin-promotions.php",
                cache: false,
                success: function(html){
                    $("#promotions-table").html(html);
                }
            });
	}
</script>