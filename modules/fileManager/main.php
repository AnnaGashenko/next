<?php
if(isset($_GET['link'])){
	$dir = $_GET['link'];
}
else{
	$dir = '.';
}
$files = scandir($dir);

$files = array_diff($files, array('.','..'));
//Как альтернатива такая же хорошая: 
// $files = unset($files[0],$files[1]); 
//. и .. всегда идут первыми.)

	
?>