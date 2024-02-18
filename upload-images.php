<pre>
    <?php
        var_dump($_FILES);
    ?>
</pre>
<?php
		function check_upload($file){
			if($file['name'] == '')
				return 'Файл не выбран';

			if($file['size'] == 0)
			return '';

			$getMime = explode('.', $file['name']);
			$mime = strtolower(end($getMime));
			$types = array('jpg', 'gif', 'jpeg','png');

			if(!in_array($mime, $types))
				return '<script language = "javascript">' .
				'alert("Недопустимый тип файла");' .		
				'window.location.href="admin-panel.php"'.		
				'</script>';
		
			return true;
		}
		
		function upload($file){
			copy($file['tmp_name'], 'Resources/portfolio/' . $file['name']);

		}

		function save($name, $mime){
			$link =  mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
			mysqli_select_db($link,"aphrodite") or die("Ошибка подключения к базе данных");
			$name_file=$name.'.'.$mime;
			$query = "INSERT INTO portfolio SET name ='{$name_file}'";
			mysqli_query($link, $query);
			if(mysqli_affected_rows($link) > 0){
				echo '';
			} else {
				echo "Ошибочка вышла.";
			}
		}
		
			
		if(isset($_FILES['file'])) {
            $normalizeImages = [];
            foreach($_FILES['file'] as $key_name => $value){
                foreach ($value as $key => $item){
                    $normalizeImages[$key][$key_name] = $item;
                }
            }
            foreach ($normalizeImages as $image){
                $check = check_upload($image);

			if ($check  ===  true) {
				upload($image);
				$getMime = explode('.', $image['name']);
				
				$mime = strtolower(end($getMime)); //тип фала
				$name = reset($getMime); //имя файла

				save($name, $mime);
				echo '<script language = "javascript">' .
					'alert("Файл загружен");' .		
                    'window.location.href="admin-panel.php"'.		
					'</script>';
					
			} else {
				echo "$check<br /><br />";
			}
            }
			
		}
		?>
        <pre>
    <?php
        var_dump($normalizeImages);
    ?>
</pre>