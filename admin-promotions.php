<style>
	.promotion-table-img{
		display:block; 
		margin:auto;
		width:100%;
		max-width: 200px;
	}
	</style>
<?php
require_once("connect_db.php");
$promotions = mysqli_query($link, 'SELECT * FROM promotions');
echo "<script>console.log(11111);</script>";
?>
<div class='add-service-btn' onclick='promotion_add();'>Добавить акцию</div>
<?php
echo "<table border=1 id='admin-promotions' width=100%>
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
					<td>" . $data['title'] . "</td>
					<td style=' word-break: break-all;'>" . $data['description'] . "</td>";
	if ($data["picture"]) {
		echo "
					<td><img class='promotion-table-img' src='Resources/promotions/" . $data['picture'] . "'></td>";
	} else {
		echo "<td align=center>-</td>";
	}
	echo "<td text-align='center'><img style='display:block; margin:auto;' src='Resources\\edit.png' title='Редактировать' width=30px onclick=promotion_edit(" . $data['id'] . ");></a></td>";
	// <td text-align='center'><a href='promotion-delete.php?promotion_id=".$data['id']."'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></a></td>
	echo "<td text-align='center'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px onclick=promotion_delete(" . $data['id'] . ");></td>
					</tr>";
	$k++;

}

echo "</table>";
?>
<script>
	function promotion_edit(id) {
		$.ajax({
			url: 'promotion-edit-popup.php',
			method: 'get',
			async: false,
			dataType: 'html',
			data: { promotion_id: id },
			success: function (data) {
				$('#popup').html(data);
				var popup_service_edit = document.querySelector(".popup-promotion-edit");
				var close_serv = document.getElementById("close-promotion-edit-btn");
				popup_service_edit.classList.toggle("popup_open");
				document.body.style.overflow = "hidden";
				close_serv.addEventListener("click", function () {
					popup_service_edit.classList.remove("popup_open");
					document.body.style.overflow = "visible";
				})
			}
		});


	}
	function promotion_add() {
		$.ajax({
			url: 'promotion-add-popup.php',
			method: 'get',
			dataType: 'html',
			success: function (data) {
				$('#popup').html(data);
				var popup_service_edit = document.querySelector(".popup-promotion-add");
				var close_serv = document.getElementById("close-promotion-add-btn");
				popup_service_edit.classList.toggle("popup_open");
				document.body.style.overflow = "hidden";
				close_serv.addEventListener("click", function () {
					popup_service_edit.classList.remove("popup_open");
					document.body.style.overflow = "visible";
				})
			}
		});

	}
</script>