<div class='add-service-btn' onclick='review_add();'>Добавить отзыв</div>
<table border=1 width=100%>
	<tr>
		<th>Кате&shyгория</th>
		<th>Наз&shyвание</th>
		<th>Цена</th>
		<th>Ре&shyдак&shyтиро&shyвать</th>
		<th>Уда&shyлить</th>
	</tr>

	<?php
	require_once ("service-add-popup.php");
	require ('connect_db.php');
	$reviews = mysqli_query($link, 'SELECT * FROM reviews');
	while ($review = mysqli_fetch_array($reviews)) {
				echo " 
					<tr id='admin-service" . $rewiew['id'] . "' >";
				echo "
					<td style=' word-break: break-all;'>" . $review['content'] . "</td>
					<td>" . $review['name'] . " </td>
					<td>" . $review['date'] . " </td>";

				echo "<td text-align='center'><img onclick=review_edit(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources/edit.png' title='Редактировать' width=30px></td>
					<td text-align='center'><img onclick=review_delete(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></td>
					</tr>";		
	}

	echo "</table>";
	mysqli_close($link);
	?>