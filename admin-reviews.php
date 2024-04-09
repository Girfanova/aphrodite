<div class='add-service-btn' onclick='review_add();'>Добавить отзыв</div>
<table id='review-table' border=1 width=100%>
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
					<td id='review_content" . $review['id'] . "'>" . $review['content'] . "</td>
					<td id='review_name" . $review['id'] . "'>" . $review['name'] . " </td>
					<td id='review_date" . $review['id'] . "'>" . $review['date'] . " </td>";

		echo "<td text-align='center'><img onclick=review_edit(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources/edit.png' title='Редактировать' width=30px></td>
					<td text-align='center'><img onclick=review_delete(" . $review['id'] . "); style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></td>
					</tr>";
	}

	echo "</table>";
	mysqli_close($link);
	?>
	<script>
		function review_edit(id) {
			$.ajax({
				method: 'post',
				data: { id: id },
				url: 'get-edit-review.php',
				type: 'json',
				async: false,
				success: function (res) {
					openPopup();
					let review = JSON.parse(res);
					document.querySelector('.popup-title').innerHTML = 'Редактирование отзыва';
					document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
					<label>Содержание</label>
					<div>
					<textarea style="min-height:200px; width:96%; height:auto; resize:none; padding:2%;" id='review_content' name='review_content'> ${review['content']}</textarea>
					</div>
					<label>Автор</label>
					<input type='text' id='review_author' name='review_author' value='${review['name']}'>
					<label>Дата</label>
					<input type='text' id='review_date' name='review_date' value='${review['date']}'>
					<input type='text' id='review_id' name='review_id' style='visibility:hidden;' value='${review['id']}'>
					`);
					document.querySelector('#form').addEventListener('submit', function () {
						var author = document.querySelector('#review_author').value;
						var date = document.querySelector('#review_date').value;
						var content = document.querySelector('#review_content').value;
						var id = document.querySelector('#review_id').value;
						var dataForm = $(this).serialize();
						console.log(dataForm);
						$.ajax({
							method: 'post',
							dataType: 'html',
							url: 'save-edit-review.php',
							async: false,
							data: dataForm,
							success: function (res) {
								alert(res);
								closePopup();
								document.getElementById('review_name' + id).innerHTML = author;
								document.getElementById('review_content' + id).innerHTML = content;
								document.getElementById('review_date' + id).innerHTML = date;
							}
						})
					})
				}
			})
		}
		function review_add() {
			openPopup();
			document.querySelector('.popup-title').innerHTML = 'Добавление отзыва';
			document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
					<label>Содержание</label>
					<div>
					<textarea style="min-height:200px; width:96%; height:auto; resize:none; padding:2%;" id='review_content' name='review_content'> </textarea>
					</div>
					<label>Автор</label>
					<input type='text' id='review_author' name='review_author' value=''>
					<label>Дата</label>
					<input type='text' id='review_date' name='review_date' value=''>
					`);
					document.querySelector('#form').addEventListener('submit', function () {
						var author = document.querySelector('#review_author').value;
						var date = document.querySelector('#review_date').value;
						var content = document.querySelector('#review_content').value;
						var dataForm = $(this).serialize();
						console.log(dataForm);
						$.ajax({
							method: 'post',
							dataType: 'html',
							url: 'save-add-review.php',
							async: false,
							data: dataForm,
							success: function (res) {
								alert(res);
								closePopup();
								//получение данных с сервера с id
								// $.ajax({
								// 	method:'post',
								// 	data: {id: id},
								// 	url:'get-new-review.php',
								// 	success:function(res){
								// 		let review = JSON.parse(res);
								// 		console.log(review);
								// 	}
								// })
								document.querySelector("#review-table").insertAdjacentHTML('beforeend',`
								// вставка строки полученной
								`)
								document.getElementById('review_name' + id).innerHTML = author;
								document.getElementById('review_content' + id).innerHTML = content;
								document.getElementById('review_date' + id).innerHTML = date;
							}
						})
					})
		}		
	</script>