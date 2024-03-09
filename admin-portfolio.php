<style>
	span {
		color: red;
		font-size: 0.8em;
	}
</style>
<form enctype="multipart/form-data" method="POST" id='portfolio-form' onsubmit="return false">
	<input type="file" id='uploadimage' name="file[]" multiple='multiple'>
	<input onclick='add_photo();' type="submit" value="Загрузить">
</form>
<?php

require_once("connect_db.php");
$files = scandir('Resources/portfolio/'); //список файлов в small/
$portfolio = mysqli_query($link, 'SELECT * FROM portfolio');

while ($data = mysqli_fetch_array($portfolio)) {
	$name = $data['name'];
	echo "<div class='portfolio-photo'>
								<img class='portfolio-img' src='Resources/portfolio/$name'><img onclick=portfolio_delete('" . $name . "'); src='Resources/delete.png' title='Удалить' class='portfolio-photo-delete'>
		</div>";
}
?>
<script>
	// window.Arr = [];
	// window.el = '$';
	// window.LengthImg = 0;
	// window.VirableLoading = 0;
	//This Virables Is Globals (Объявляем переменные)
	//Download Pictures (Загрузка изображений)
	//Create Object FormData (Создание объекта типа form)
	function add_photo() {
		var formData = new FormData();
		//Если выбранные изображение больше 10
		if($('#uploadimage')[0].files.length > 10)  {alert('Файлов больше 5'); return false};
		//Insert File Listes In An Object FormData (Создание вставки массивов изображений $_FILES в объект formdata )
		// alert('Неверный тип данных. Загрузите .png .jpeg .jpg или .gif');
		$.each($('#uploadimage')[0].files, function(count, This_File) {
			//If MIME Type Of Picture Not Match With That Formats (Если не соответствует тип)
			if(!This_File.type.match(/(.png)|(.jpeg)|(.jpg)|(.gif)$/i) || ($('#uploadimage')[0].files[count].size / 1024).toFixed(0) > 1524) {
				alert('Неверный тип файла - '+ This_File.name +'.\nЗагрузите png, jpeg, jpg, или gif.');
				return false;
			}
					 //Иначе
			else {
				//Append Objects ( вставляем массивы изображений $_FILES в объект formdata )
				formData.append("image" + count, This_File);
						   //Если мы уже вставили все изображения
				if(count == $('#uploadimage')[0].files.length - 1) {
					//var query = 0;
								   //Вторая защита (если имя НЕ неизвестно)
					if($("#uploadimage")[0].files[0].name != undefined){
						//Query 
						$.ajax({
							url: 'upload-images.php',
							type: 'POST',
							contentType: false,
							processData: false,
							async:false,
							dataType: 'json',
							data: formData,
							beforeSend: function(loading) { $('.loading').css("display", "block"); },
							success: alert('Файлы загружены')
							// function(data) { 
							// 	if(data['state'] == "success") {
							// 		VirableLoading++;
							// 		$('.loading').css("display", "none");
							// 		//Cycle
							// 		for(var i = 0; i < data['lengthArr'] + 1; i++) {
							// 			//Loading More Photos
							// 			Arr[LengthImg + i] =  data['srcPart'][i];
							// 			//If the cycle is ended
							// 			if(i == data['lengthArr']) {
							// 				//Length Photos
							// 				LengthImg += data['lengthArr'] + 1;
							// 				//How Much Pictures Downloaded
							// 				$('#DownloadedPics').val("Загружено (" + LengthImg + ")");
							// 			} 
							// 		}
							// 	}
							// }
						});
						$.ajax({
			url: "admin-portfolio.php",
			cache: false,
			success: function (php) {
				$("#portfolio-table").html(php);
			}
		});
					}
				}
			}
		}); 
	
}

	// function add_photo() {
	// 	var $input = $("#uploadimage");
	// 	var fd = new FormData;

	// 	fd.append('img', $input.prop('files')[0]);

	// 	$.ajax({
	// 		url: 'upload-images.php',
	// 		data: fd,
	// 		async:false,
	// 		processData: false,
	// 		contentType: false,
	// 		type: 'POST',
	// 		success: function (data) {
	// 			alert(data);
	// 		}
	// 	});
		
	// 	$.ajax({
	// 		url: "admin-portfolio.php",
	// 		cache: false,
	// 		success: function (php) {
	// 			$("#portfolio-table").html(php);
	// 		}
	// 	});
	// }
</script>