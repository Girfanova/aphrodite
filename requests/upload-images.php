
<?php 
// function check_upload($file)
// {
// 	if ($file['name'] == '')
// 		return 'Файл не выбран';

// 	if ($file['size'] == 0)
// 		return '';

// 	$getMime = explode('.', $file['name']);
// 	$mime = strtolower(end($getMime));
// 	$types = array('jpg', 'gif', 'jpeg', 'png');

// 	if (!in_array($mime, $types)) 
// 		return "Недопустимый тип файла";
// 		// return '<script language = "javascript">' .
// 		// 	'alert("Недопустимый тип файла");' .
// 		// 	'window.location.href="admin-panel.php"' .
// 		// 	'</script>';

// 	return true;
// }

// function upload($file)
// {
// 	copy($file['tmp_name'], 'Resources/portfolio/' . $file['name']);

// }

// function save($name, $mime)
// {
// 	require_once("connect_db.php");
// 	$name_file = $name . '.' . $mime;
// 	$query = "INSERT INTO portfolio SET name ='{$name_file}'";
// 	mysqli_query($link, $query);
// 	if (mysqli_affected_rows($link) > 0) {
// 		echo '';
// 	} else {
// 		echo "Ошибочка вышла.";
// 	}
// }


// if (isset($_FILES['file'])) {
// 	$normalizeImages = [];
// 	foreach ($_FILES['file'] as $key_name => $value) {
// 		foreach ($value as $key => $item) {
// 			$normalizeImages[$key][$key_name] = $item;
// 		}
// 	}
// 	foreach ($normalizeImages as $image) {
// 		$check = check_upload($image);

// 		if ($check === true) {
// 			upload($image);
// 			$getMime = explode('.', $image['name']);

// 			$mime = strtolower(end($getMime)); //тип фала
// 			$name = reset($getMime); //имя файла

// 			save($name, $mime);
// 			// echo '<script language = "javascript">' .
// 			// 	'alert("Файл загружен");' .
// 			// 	'window.location.href="admin-panel.php"' .
// 			// 	'</script>';

// 		} else {
// 			echo "$check<br /><br />";
// 		}
// 	}

// }
// ?>

<?php
    $Array = array();
    $count = -1;
    foreach($_FILES as $Pictures) {
        $count++;
		copy($Pictures['tmp_name'], 'Resources/portfolio/' . $Pictures['name']);
		require_once("connect_db.php");
		$name_file = $Pictures['name'];
		$query = "INSERT INTO portfolio SET name ='{$name_file}'";
		mysqli_query($link, $query);
		if (mysqli_affected_rows($link) > 0) {
			echo '';
		} else {
			echo "Ошибочка вышла.";
		}

        $Array[$count] = $namePic;
    }
 
    $json_data = array ('srcPart' => $Array, 'lengthArr' => $count, 'state' => "success");
    echo json_encode($json_data);
?>