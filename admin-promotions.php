<?php

$promotions = mysqli_query($link, 'SELECT * FROM promotions');

?>
<pre>
	<?php
	//print_r($services_data);
	?>
</pre>
<a class='add-service-btn' href='promotion-add.php' >Добавить акцию</a>
<?php
echo "<table border=1 width=100%>
		<tr>
		<th>Заголовок</th>
		<th>Описание</th>
		<th>Картинка</th>
		<th width=12% text-align='center'>Редактировать</th>
		<th width=8% text-align='center'>Удалить</th>
		<tr>
		";

while ($data = mysqli_fetch_array($promotions)) {

			echo "
					<td>" . $data['title'] . "</td>
					<td>" . $data['description'] . "</td>";
                    if ($data["picture"]){
                    echo"
					<td><img style='display:block; margin:auto;' width=200px src='Resources/promotions/" . $data['picture'] . "'></td>";}
                    else {echo "<td align=center>-</td>";}
					echo "<td text-align='center'><a href='promotion-edit.php?promotion_id=".$data['id']."'><img style='display:block; margin:auto;' src='Resources\\edit.png' title='Редактировать' width=30px></a></td>
					<td text-align='center'><a href='promotion-delete.php?promotion_id=".$data['id']."'><img style='display:block; margin:auto;' src='Resources\delete.png' title='Удалить' width=30px></a></td>
					</tr>";
			$k++;
		
}

echo "</table>";
?>
