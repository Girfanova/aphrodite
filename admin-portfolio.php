<form enctype="multipart/form-data" method="POST" id='portfolio-form' onsubmit="return false">
	<input type="file" id='uploadimage' name="file[]" multiple='multiple'>
	<input onclick='add_photo();' type="submit" value="Загрузить">
</form>
<table class='admin-portfolio-table' border=1 width=100%>
	<tr>
		<th>Изображение</th>
		<th>Описание</th>
		<th>Ре&shyдак&shyти&shyро&shyвать</th>
		<th>Уда&shyлить</th>
	</tr>
<?php
require_once("connect_db.php");

$files = scandir('Resources/portfolio/'); //список файлов в small/
$portfolio = mysqli_query($link, 'SELECT * FROM portfolio order by id desc');

while ($data = mysqli_fetch_array($portfolio)) {
	$name = $data['name'];
	$description = $data['description'];
	$id = $data['id'];
	// echo "<div class='portfolio-photo'>
			echo	"<tr id='admin-portfolio".$id."'>
			<td class='img-td'><a data-fancybox='images' data-caption='$description' href='Resources/portfolio/$name'><img class='portfolio-img' title='$description' src='Resources/portfolio/$name'><img></a></td>
				<td>$description</td>
				<td><img onclick=portfolio_edit('" . $id . "'); src='Resources/edit.png' title='Редакировать' class='portfolio-photo-delete'></td>
				<td><img onclick=portfolio_delete('" . $id . "'); src='Resources/delete.png' title='Удалить' class='portfolio-photo-delete'></td>
		</tr>";
		// </div>";
}

?>
</table>
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
		if($('#uploadimage')[0].files.length > 10)  {alert('Файлов больше 10'); return false};
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
							success: function(data) { 
								data =JSON.parse(data);
								console.log(data); 
								let last_picture = $('.admin-portfolio-table:last');
								last_picture.after(`<tr id='admin-portfolio".$data['id']."'>
			<td class='img-td'><a data-fancybox='images' data-caption='$description' href='Resources/portfolio/$name'><img class='portfolio-img' title='$description' src='Resources/portfolio/$name'><img></a></td>
				<td>$description</td>
				<td><img onclick=portfolio_edit('" . $name . "'); src='Resources/edit.png' title='Редакировать' class='portfolio-photo-delete'></td>
				<td><img onclick=portfolio_delete('" . $name . "'); src='Resources/delete.png' title='Удалить' class='portfolio-photo-delete'></td>
		</tr>`);
							}
							// alert('Файлы загружены')
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
				alert("Успешно!");
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

	function portfolio_edit(id) {
		console.log(id);
		$.ajax({
			url: 'portfolio-edit-popup.php',
			method: 'get',
			async: false,
			dataType: 'html',
			data: { id: id },
			success: function (data) {
				$('#popup').html(data);
				var popup_service_edit = document.querySelector(".popup-portfolio-edit");
				var close_serv = document.getElementById("close-portfolio-edit-btn");
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