<div class='add-service-btn' onclick='review_add();'>Добавить отзыв</div>
<table border=1 width=100%>
	<tr>
		<th>Содержание</th>
		<th>Автор</th>
		<th>Дата</th>
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
					<td>" . $review['content'] . "</td>
					<td>" . $review['name'] . " </td>
					<td>" . $review['date'] . " </td>";

				echo "<td text-align='center'><img onclick=review_edit(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources/edit.png' title='Редактировать' width=30px></td>
					<td text-align='center'><img onclick=review_delete(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></td>
					</tr>";		
	}

	echo "</table>";
	mysqli_close($link);
	?>
	<script>
		function review_edit(id){
			$.ajax({
				method:'post',
				data: {id : id},
				url:'get-edit-review.php',
				type:'json',
				success:function(res){
					console.log(JSON.parse(res));
					let review =JSON.parse(res);
					document.querySelector('.popup-title').innerHTML='Редактирование отзыва';
					document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
					<label>Содержание</label>
					<div>
					<textarea style="min-height:200px; width:96%; height:auto; resize:none; padding:2%;" name='review_content'> ${review['content']}</textarea>
					</div>
					<label>Автор</label>
					<input type='text' name='review_author' value='${review['name']}'>
					<label>Дата</label>
					<input type='text' name='review_date' value='${review['date']}'>
					<input type='text' name='review_id' value='${review['id']}'>
					`);
					document.querySelector('#form').addEventListener('submit', function(){
						var dataForm = $(this).serialize();
						console.log(dataForm);
						$.ajax({
							method:'post',
							type:'json',
							url:'save-edit-review.php',
							contentType: 'charset=utf-8',
							data: dataForm,
							success:function(res){
								alert(res);
							}
						})
					})
					openPopup();
				}
			})
		}
	</script>