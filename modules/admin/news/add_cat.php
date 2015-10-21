<?php

//Создаем массив с категориями
//$category = array('Холодильники', 'Пылесосы','Телевизоры');

if(isset($_POST['add'], $_POST['name'])){
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	if(empty($_POST['name'])){
		$error = 'Вы не заполнили поле категория';
	} else {	
		// Делаем проверку существует ли такая категория
		$res = q("
			SELECT `id`
			FROM `news_cat`
			WHERE `name` = '".stringAll($_POST['name'])."'
			LIMIT 1
		"); 
		// mysqli_num_rows - возвращает количество найденых строк
		// Если найдет запись (true), то значит такой логин уже занят, если нет (false) - свободен (нет записи)
		if($res->num_rows) {
			$error = 'Такая категория уже есть';
		}
	}
	//Если ошибок нет, то добавляем данные в БД
	if(!isset($error)) {
		q("
			INSERT INTO `news_cat` SET
			`name`       = '".stringAll($_POST['name'])."',
			`description` = '".stringAll($_POST['description'])."',
			`text`        = '".stringAll($_POST['text'])."'
		");
		$_SESSION['info'] = 'Категория была добавлена';
		header('Location: /admin/news/main_cat');
		exit();
	}
}
