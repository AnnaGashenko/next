<?php

if(isset($_POST['submit'], $_POST['title'], $_POST['cat_id'], $_POST['text'], $_POST['description'])){
	// Создаем массив с ошибками
	$errors = array();


	//Применяем функцию, чтобы убрать лишние проблелы в предложении - trim()	
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
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
	
	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `news` SET
			`title`       = '".stringAll($_POST['title'])."',
			`cat`         = '".stringAll($_POST['cat'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."',
			`date` = NOW()
		");
		
		$_SESSION['info'] = 'Запись была добалена';
		header('Location: /admin/news');
		exit();
	}
}

$res = q("
	SELECT *
	FROM `news_cat`
	ORDER BY `id`
");


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