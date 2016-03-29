<?php foreach($files as $value) {	?>
	<div class="file">
		<?php if(is_dir($dir . '/' .$value)){
			echo '<a href="index.php?module=fileManager&link='.$dir . '/' .$value.'"> <img class="file_margin" src="/skins/default/img/folder.jpg" width="12" height="9,5" alt="папка" >'.$value. '</a> <br>';
			// Если файл не является папкой, то добаляем к нему иконку файла	
		} else {
			echo '<img class="file_margin" src="/skins/default/img/fille.jpg" width="8" height="9,5" alt="файл">'.$value. '<br>';
		} ?>		
	</div>
<?php } ?>