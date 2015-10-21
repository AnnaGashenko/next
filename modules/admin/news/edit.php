<?php

if(isset($_POST['edit'], $_POST['title'], $_POST['cat'], $_POST['text'], $_POST['description'])){
	//Применяем функцию, чтобы убрать лишние проблелы в предложении - trim()	
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	
	// Создаем массив с ошибками
	$errors = array();
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
	
	
	//Если ошибок нет, то добавляем отредактированные данные в БД
	if(!count($errors)){
		q("
			UPDATE `news` SET
			`title`       = '".stringAll($_POST['title'])."',
			`cat`         = '".stringAll($_POST['cat'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."'
			WHERE `id`    = ".(int)$_GET['id']."
			");
	
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /admin/news');
		exit();
	}
}


//Создаем массив с категориями
$res = q("
	SELECT *
	FROM `news_cat`
	ORDER BY `id`
");
	
//В поля формы нужно подставить данные из БД для их редактирования
$news = q("
	SELECT *
	FROM `news`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");

// Проверяем существует ли данная запись (если ввести в адреснуб строку id новости которой нет)
if(!$news->num_rows) {
	$_SESSION['info'] = 'Данной новости не существует!';
	header("Location: /admin/news");
	exit();
}

$row = $news->fetch_assoc();

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