<?php

if(isset($_POST['edit'], $_POST['name'])){
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}
	if(empty($_POST['name'])){
		$error = 'Вы не заполнили поле категория';
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
	//Если ошибок нет, то обновляем данные в БД
	if(!isset($error)) {
		q("
			UPDATE `goods_cat` SET
			`name`       = '".stringAll($_POST['name'])."',
			`description` = '".stringAll($_POST['description'])."',
			`text`        = '".stringAll($_POST['text'])."'
			WHERE `id`    = ".(int)$_GET['id']."
		");
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /admin/goods/main_cat');
		exit();
	}
}
		
//В поля формы нужно подставить данные из БД для их редакатирования
$res = q("
	SELECT *
	FROM `goods_cat`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");
$row = $res->fetch_assoc();

// Проверяем существует ли данная запись (если ввести в адреснуб строку id категории которой нет)
if(!$res->num_rows) {
	$_SESSION['info'] = 'Данной категории не существует!';
	header("Location: /admin/goods/main_cat");
	exit();
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