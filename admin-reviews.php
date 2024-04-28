<div class='add-service-btn' onclick='review_add();'>Добавить отзыв</div>
<table id='review-table' class='admin-table' >
	<tr>
		<th>Содержание</th>
		<th>Автор</th>
		<th>Дата</th>
		<th>Редак&shyтиро&shyвать</th>
		<th>Уда&shyлить</th>
	</tr>

	<?php
	require ('connect_db.php');
	$reviews = mysqli_query($link, 'SELECT * FROM reviews');
	while ($review = mysqli_fetch_array($reviews)) {
		echo " 
					<tr id='admin-review" . $review['id'] . "' >";
		echo "
					<td id='review_content" . $review['id'] . "'>" . $review['content'] . "</td>
					<td id='review_name" . $review['id'] . "'>" . $review['name'] . " </td>
					<td id='review_date" . $review['id'] . "'>" . $review['date'] . " </td>";

		echo "
				<td><span onclick=review_edit(" . $review['id'] . "); class='material-symbols-outlined' title='Редакировать'>edit</span></td>
				<td><span onclick=review_delete(" . $review['id'] . "); class='material-symbols-outlined' title='Удалить'>delete</span></td>
				</tr>";
	}

	echo "</table>";
	mysqli_close($link);
	?>