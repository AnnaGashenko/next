<?php
foreach($files as $value){	
	if(is_dir($dir . '/' .$value)){
		echo '<a href="index.php?module=fileManager&page=program1&link='.$dir . '/' .$value.'"> <img src="/images/folder.jpg" width="24" height="19" alt="папка" >'.$value. '</a> <br>';				
	}		
	// Если файл не является папкой, то добаляем к нему иконку файла	
	else{
		echo '<img src="/images/fille.jpg" width="16" height="19" alt="файл">'.$value. '<br>';
	}
}

?>