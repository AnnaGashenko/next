<?php

if(isset($_POST['add'], $_POST['title'], $_POST['cat'], $_POST['text'], $_POST['description'], $_POST['cod'], $_POST['price'])){
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
	if(empty($_POST['cod'])){
		$errors['cod'] = 'Вы не ввели код товара';
	}
	if(empty($_POST['price'])){
		$errors['price'] = 'Вы не ввели цену товара';
	}
	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		mysqli_query($link,"
		INSERT INTO `goods` SET
		`title`       = '".mysqli_real_escape_string($link,$_POST['title'])."',
		`cat`         = '".mysqli_real_escape_string($link,$_POST['cat'])."',
		`text`        = '".mysqli_real_escape_string($link,$_POST['text'])."',
		`description` = '".mysqli_real_escape_string($link,$_POST['description'])."',
		`cod`         = '".(int) $_POST['cod']."',
		`price`       = '".(int) $_POST['price']."'
		
		") or exit(mysqli_error($link)); // провяряем запрос на ошибки
		
		$_SESSION['info'] = 'Товар был добавлен';
		header('Location: /index.php?module=goods');
		exit();
	}
}

/* trim() - убирает пробелы в начале и в конце
 принимает параметрв: Текст<br />
Возвращает (return) - текст без пробелов
можно сделать короче и обработать данные в цикле
foreach($_POST as $k => $v){
	$_POST[$k] = trim($v);
}
mysqli_real_escape_string - экранирует кавычки и слеши
Входящие прараметры: 1. Ссылка на коннект 2. Переменная, которую нужно эранировать
Выходящие параметры: экранированный текст


*/