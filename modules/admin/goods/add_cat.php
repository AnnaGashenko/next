<?php

//Создаем массив с категориями
//$category = array('Холодильники', 'Пылесосы','Телевизоры');

if(isset($_POST['name'], $_POST['description'], $_POST['text'])){
	
	$errors = array();
	
	if(empty($_POST['text'])){
	$errors['text'] = 'Вы не ввели текст';
	}
	if(empty($_POST['description'])){
		$errors['description'] = 'Вы не заполнили поле описание';
	}

	if(empty($_POST['name'])){
		$errors['name'] = 'Вы не заполнили поле категория';
	} else {	
		// Делаем проверку существует ли такая категория
		$res = q("
			SELECT `id`
			FROM `goods_cat`
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
	if(!isset($errors)) {
		q("
			INSERT INTO `goods_cat` SET
			`name`       = '".stringAll($_POST['name'])."',
			`description` = '".stringAll($_POST['description'])."',
			`text`        = '".stringAll($_POST['text'])."'
		");
		$_SESSION['info'] = 'Категория была добавлена';
		header('Location: /admin/goods/main_cat');
		exit();
	}
}
