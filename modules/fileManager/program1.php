<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');


$fail = '<img src="fail.png">';
$papka = '<img src="papka.png">';

$dir = './../';
$files1 = scandir($dir);

foreach($files1 as $k => $v){
 if(is_dir('./../'.$v)){
  echo '<pre>'.'<a href="/program1.php?page=program1&link='.$v.'">'.$v.$papka.'</a>'.'</pre>'; 
 } else {
  echo '<pre>'.$v.$fail.'</pre>';
 }
}

?>