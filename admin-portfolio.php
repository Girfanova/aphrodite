<form enctype="multipart/form-data" method="POST" id='portfolio-form' onsubmit="return false">
	<input type="file" class="input-file" id='uploadimage' onchange="changeInputPhoto(this);" name="file[]" multiple='multiple'>
	<label for="uploadimage" class="upload-wrapper">
		<div class="upload-text">Файл не выбран</div>
		<div class="upload-btn">Выбрать фото</div>
	</label>
	<input onclick='add_photo();' class="btn add-photo-btn" type="submit" value="Сохранить">
	<div style="width:100%; font-size:0.7em;">*Загружайте не более 10 фотографий за раз</div>
</form>
<table class='admin-table'>
	<tr>
		<th>Изображение</th>
		<th>Описание</th>
		<th>Ре&shyдак&shyти&shyро&shyвать</th>
		<th>Уда&shyлить</th>
	</tr>
<?php
require("connect_db.php");

$files = scandir('Resources/portfolio/'); //список файлов в small/
$portfolio = mysqli_query($link, 'SELECT * FROM portfolio order by id desc');

while ($data = mysqli_fetch_array($portfolio)) {
	$name = $data['name'];
	$description = $data['description'];
	$id = $data['id'];
	// echo "<div class='portfolio-photo'>
			echo	"<tr id='admin-portfolio".$id."'>
			<td class='img-td'><a href='Resources/portfolio/$name'><img class='portfolio-img' title='$description' src='Resources/portfolio/$name'><img></a></td>
				<td class='description'>$description</td>
				<td><img onclick=portfolio_edit('" . $id . "'); src='Resources/edit.png' title='Редакировать' class='portfolio-photo-delete'></td>
				<td><img onclick=portfolio_delete('" . $id . "'); src='Resources/delete.png' title='Удалить' class='portfolio-photo-delete'></td>
		</tr>";
		// </div>";
}
mysqli_close($link);
?>
</table>