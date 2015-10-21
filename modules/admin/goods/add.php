<?php

//Создаем массив с категориями
//$category = array('Холодильники', 'Пылесосы','Телевизоры');

if(isset($_POST['add'], $_POST['text'], $_POST['description'], $_POST['cod'], $_POST['price'])){
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	$errors = array();
	
	$good['small'] = '/uploaded/goods/100x100/no-foto.png';
	$good['big']   = '/uploaded/goods/140x140/no-foto.png';
	
	if($_FILES['file']['error'] == 0) {
		if($temp = Uploader::upload($_FILES['file'], 'goods')) {
			$good['small'] = Uploader::resize($temp,100,100);
			$good['big']   = Uploader::resize($temp,140,140);
		} else {
			$errors['file'] = Uploader::$error;
		}		
	} 
	
	if(empty($_POST['title'])){
		$errors['title'] = 'Вы не заполнили поле заголовок';
	}
	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Вы не выбрали категорию';
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
		q("
			INSERT INTO `goods` SET
			`title`       = '".stringAll($_POST['title'])."',
			`cat`         = '".stringAll($_POST['cat'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."',
			`cod`         = '".(int) $_POST['cod']."',
			`price`       = '".(int) $_POST['price']."',
			`good_small`  = '".stringAll($good['small'])."',
			`good_big`    = '".stringAll($good['big'])."'
		");
		$_SESSION['info'] = 'Товар был добавлен';
		header('Location: /admin/goods');
		exit();
	}
}

$res = q("
	SELECT *
	FROM `goods_cat`
	ORDER BY `id`
");