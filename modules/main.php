<?php

$page = ($_GET['page']);
$page_num = !isset($_GET['page_num']) || ($_GET['page_num'] <= 0) ?  1 : (int)$_GET['page_num'];
$module = stringAll($_GET['module']);


	// Определяем общее число сообщений в выбранной категории 
	$res = q("
		SELECT 
		COUNT(*) 
		FROM `".$module."`
	");
	if($res->num_rows) {
		Paginator::__($page_num,$page,$module,$res); 
				
		$result = q("
			SELECT *
			FROM `".$module."`
			ORDER BY `id`
			LIMIT ".Paginator::$shift.",". Paginator::$num."
		");
	}
	

//Обработка регистрации
if(isset($_POST['login'],$_POST['email'],$_POST['text'])){
	// Создаем массив с ошибками
	$errors = array();
	if(empty($_POST['login'])){
		$errors['login'] = 'Вы не заполнили поле логин';
	}
	//Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Вы не ввели email, или ввели не верно';
	}
	if(empty($_POST['text'])){
		$errors['text'] = 'Вы не ввели текст';
	}
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `reviews` SET
			`login` = '".stringAll($_POST['login'])."',
			`email` = '".stringAll($_POST['email'])."',
			`text`  = '".stringAll($_POST['text'])."',
			`date`  = NOW()
		");
		//Записываем переменную в сессию, чтобы сохранить ее между страницами
		$_SESSION['regok'] = 'OK';
		// Делаем переадресацию на эту же страницу
		header("Location: /index.php?module=reviews");
		exit();
	}
}
