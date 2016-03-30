<?php
// Если пользователь не авторизирован или он не админ
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5 ) { 
	include './modules/cab/auth.php'; 
}

?>

