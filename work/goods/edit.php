<?php

if(isset($_POST['edit'], $_POST['title'], $_POST['cat'], $_POST['text'], $_POST['description'], $_POST['cod'], $_POST['price'])){
	//Применяем функцию, чтобы убрать лишние проблелы в предложении - trim()	
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	
	mysqli_query($link,"
		UPDATE `goods` SET
		`title`       = '".mysqli_real_escape_string($link,$_POST['title'])."',
		`cat`         = '".mysqli_real_escape_string($link,$_POST['cat'])."',
		`text`        = '".mysqli_real_escape_string($link,$_POST['text'])."',
		`cod`         = '".mysqli_real_escape_string($link,$_POST['cod'])."',
		`text`        = '".mysqli_real_escape_string($link,$_POST['text'])."',
		`price` = '".mysqli_real_escape_string($link,$_POST['price'])."'
		WHERE `id`    = ".(int)$_GET['id']."
		") or exit(mysqli_error($link));
		
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /index.php?module=goods');
		exit();
}
		
//В поля формы нужно подставить данные из БД для их редакатирования
$goods = mysqli_query($link,"
	SELECT *
	FROM `goods`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
") or exit(mysqli_error($link));

// Проверяем существует ли данная запись (если ввести в адреснуб строку id новости которой нет)
if(!mysqli_num_rows($goods)) {
	$_SESSION['info'] = 'Данной новости не существует!';
	header("Location: /index.php?module=goods");
	exit();
}

$row = mysqli_fetch_assoc($goods);

if(isset($_POST['title'])){
	$row['title'] = $_POST['title'];
}

/*
LIMIT - это оптимизация для более быстрых запросов
Если мы точно знаем, что с таким id у нас всего одна запись
Мы говорим системе, что нам нужно выбрать всего одну запись LIMIT 1
Иначе будут перебирать все записи находящиеся в БД
Процесс:
находит нашу запись -> смотрит LIMIT -> видит что он = 1 -> все обрывает дальше поиск
*/