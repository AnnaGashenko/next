<?php
if(isset($_POST['add'], $_POST['text'], $_POST['author'])){
	$errors = array();

	$res = q("
		SELECT `id`
		FROM `books_author`
		WHERE `author` = '".stringAll($_POST['author'])."'
		LIMIT 1
	"); 
	// mysqli_num_rows - возвращает количество найденых строк
	// Если найдет запись (true), то значит такой логин уже занят, если нет (false) - свободен (нет записи)
	if($res->num_rows) {
		$errors['author'] = 'Такой автор уже есть';
	}

	$author['small'] = '/uploaded/author/100x150/no-foto.png';
	$author['big']   = '/uploaded/author/228x300/no-foto.png';
	
	if($_FILES['file']['error'] == 0) {
		if($temp = Uploader::upload($_FILES['file'], 'author')) {
			$author['small'] = Uploader::resize($temp,100,150);
			$author['big']   = Uploader::resize($temp,228,300);
		} else {
			$errors['file'] = Uploader::$error;
		}		
	} 
	
	if(empty($_POST['text'])){
		$errors['text'] = 'Вы не ввели текст';
	}
	if(empty($_POST['author'])){
		$errors['author'] = 'Вы не ввели автора';
	}		
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){	
		q("
			INSERT INTO `books_author` SET
			`text`         = '".stringAll($_POST['text'])."',
			`author`       = '".stringAll($_POST['author'])."',
			`author_small` = '".stringAll($author['small'])."',
			`author_big`   = '".stringAll($author['big'])."'
		");
		$_SESSION['info'] = 'Автор был добавлен';
		header('Location: /admin/books');
		exit();
	}
}
