<?php

// Например у человека нет прав ['user']['access'] != 5 и он пытается открыть другую страницу кроме главной
if((!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) && ($_GET['module'] != 'static' || $_GET['page'] != 'main')) { 
	// Делаем переадресацию на главную
	header("Location: /admin/static/main");
	exit();
}
