<style>
	span{
		color:red;
		font-size:0.8em;
	}
	
	</style>
<form enctype="multipart/form-data" method="POST" id='portfolio-form' action='upload-images.php'>
			<input type="file" name="file[]" multiple='multiple'><br><br>
			<input type="submit" value="Загрузить">
		</form>
		
		<?php
		
		
		$files = scandir('Resources/portfolio/'); //список файлов в small/
		$portfolio = mysqli_query($link, 'SELECT * FROM portfolio');
		
		while ($data = mysqli_fetch_array($portfolio)) {
			$name = $data['name'];
			echo "<div class='portfolio-photo'>
								<img class='portfolio-img' src='Resources/portfolio/$name'><a href='portfolio-photo-delete.php?name_image=".$name."'><img src='Resources/delete.png' title='Удалить' class='portfolio-photo-delete'></a></div>";
		}
		?>
		
	


