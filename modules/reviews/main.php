<?php
$page = ($_GET['page']);
$page_num = !isset($_GET['page_num']) || ($_GET['page_num'] <= 0) ?  1 : (int)$_GET['page_num'];
$module = stringAll($_GET['module']);

// Определяем общее число сообщений
$res = q("
	SELECT 
	COUNT(*) 
	FROM `".$module."`
");
$row3 = $res->fetch_row();
$total = $row3[0]; // всего записей на странице

if($res->num_rows) {
	Paginator::__($page_num,$page,$module,$res); 
			
	$result = q("
		SELECT *
		FROM `".$module."`
		ORDER BY `id` DESC
		LIMIT ".Paginator::$shift.",". Paginator::$num."
	");	
	
}	
//Обработка авторизации
if(isset($_POST['reviews_login'],$_POST['reviews_email'],$_POST['reviews_text'])){
	// Создаем массив с ошибками
	$errors = array();

	if(empty($_POST['reviews_login'])){
		$errors['reviews_login'] = 'Вы не заполнили поле логин';
	}
	//Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['reviews_email']) || !filter_var($_POST['reviews_email'],FILTER_VALIDATE_EMAIL)){
		$errors['reviews_email'] = 'Вы не ввели email, или ввели не верно';
	}
	if(empty($_POST['reviews_text'])){
		$errors['reviews_text'] = 'Вы не ввели текст';
	}
	
	// Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `reviews` SET
			`reviews_login` = '".stringAll($_POST['reviews_login'])."',
			`reviews_email` = '".stringAll($_POST['reviews_email'])."',
			`reviews_text`  = '".stringAll($_POST['reviews_text'])."',
			`date`  = NOW()
		");
		
		// Возвращает автоматически генерируемый ID, используя последний запрос
		// Записываем последний id в сессию
		// $_SESSION['id'] = DB::_()->insert_id;

		$new_mess = q("
			SELECT *
			FROM `reviews`
			WHERE `id` > '".(int)$_SESSION['id']."'
		");
		if($new_mess->num_rows) {
			$date = $new_mess->fetch_assoc();
			echo $date['date'];
		} 
		exit();

	}
	exit();
}
