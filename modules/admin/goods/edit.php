<?php

if(isset($_POST['edit'], $_POST['title'], $_POST['cat'], $_POST['text'], $_POST['description'], $_POST['cod'], $_POST['price'])){
	//Применяем функцию, чтобы убрать лишние проблелы в предложении - trim()	
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	
	// Создаем массив с ошибками
	$errors = array();
	
	if($_FILES['file']['error'] == 0) {
		if($temp = Uploader::upload($_FILES['file'], 'goods')) {
			$photo['small'] = Uploader::resize($temp,100,100);
			$photo['big']   = Uploader::resize($temp,140,140);
		} else {
			$errors['file'] = Uploader::$error;
		}
	} 
	if(empty($_POST['title'])){
		$errors['title'] = 'Вы не заполнили поле заголовок';
	}
	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Вы не заполнили поле категория';
	}
	if(empty($_POST['text'])){
		$errors['text'] = 'Вы не ввели текст';
	}
	if(empty($_POST['description'])){
		$errors['description'] = 'Вы не заполнили поле описание';
	}
	if(empty($_POST['cod'])){
		$errors['cod'] = 'Вы не ввели код товара';
	}
	if(empty($_POST['price'])){
		$errors['price'] = 'Вы не ввели цену товара';
	}
	
	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		if(isset($photo['small'], $photo['big'])) {
			$photo = ",`photo_small` = '".stringAll($photo['small'])."'"; 
			$photo   = ",`photo_big`   = '".stringAll($photo['big'])."'"; 
		} 
		q("
			UPDATE `goods` SET
		    `title`       = '".stringAll($_POST['title'])."',
			`cat`         = '".stringAll($_POST['cat'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."',
			`cod`         = '".(int) $_POST['cod']."',
			`price`       = '".(int) $_POST['price']."'
			".(isset($small) ? $small : '')."
			".(isset($big) ? $big : '')."
			WHERE `id`    = ".(int)$_GET['id']."
		");
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /admin/goods');
		exit();
	}
}
//Создаем массив с категориями
$res = q("
	SELECT *
	FROM `goods_cat`
	ORDER BY `id`
");
		
//В поля формы нужно подставить данные из БД для их редакатирования
$goods = q("
	SELECT *
	FROM `goods`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");
$row = $goods->fetch_assoc();

// Проверяем существует ли данная запись (если ввести в адреснуб строку id новости которой нет)
if(!$goods->num_rows) {
	$_SESSION['info'] = 'Данного товара не существует!';
	header("Location: /admin/goods");
	exit();
}



if(isset($_POST['title'])){
	$row['title'] = $_POST['title'];
}




//wtf($_POST['edit'],1);

/*
LIMIT - это оптимизация для более быстрых запросов
Если мы точно знаем, что с таким id у нас всего одна запись
Мы говорим системе, что нам нужно выбрать всего одну запись LIMIT 1
Иначе будут перебирать все записи находящиеся в БД
Процесс:
находит нашу запись -> смотрит LIMIT -> видит что он = 1 -> все обрывает дальше поиск
*/