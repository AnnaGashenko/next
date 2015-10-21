<?php

if(isset($_POST['add'], $_POST['text'], $_POST['cod'], $_POST['price'])){

	$errors = array();
	
	$book['small'] = '/uploaded/books/100x150/no-foto.png';
	$book['big']   = '/uploaded/books/250x300/no-foto.png';
	
	if($_FILES['file']['error'] == 0) {
		if($temp = Uploader::upload($_FILES['file'], 'books')) {
			$book['small'] = Uploader::resize($temp,100,150);
			$book['big']   = Uploader::resize($temp,200,300);
		} else {
			$errors['file'] = Uploader::$error;
		}		
	} 
	
	if(empty($_POST['title'])){
		$errors['title'] = 'Вы не заполнили поле заголовок';
	}
	if(empty($_POST['author'])) {
		$errors['author'] = 'Вы не выбрали автора';
	}
	if(empty($_POST['text'])){
		$errors['text'] = 'Вы не ввели текст';
	}
	if(empty($_POST['cod'])){
		$errors['cod'] = 'Вы не ввели код товара';
	}
	$res = q("
		SELECT `cod`
		FROM `books`
		WHERE `cod` = '".stringAll($_POST['cod'])."'
		LIMIT 1
	"); 
	if(mysqli_num_rows($res)) {
		$errors['cod'] = 'Такой код уже записан в базу данных';
	}
	if(empty($_POST['price'])){
		$errors['price'] = 'Вы не ввели цену товара';
	}		
		
	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `books` SET
			`title`       = '".stringAll($_POST['title'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."',
			`cod`         = '".(int) $_POST['cod']."',
			`price`       = '".(int) $_POST['price']."',
			`book_small`  = '".stringAll($book['small'])."',
			`book_big`    = '".stringAll($book['big'])."'
		");		
		
		$res = q("
			SELECT `id`
			FROM `books`
			WHERE `cod` = '".(int) $_POST['cod']."'
		");
		$row2 = $res->fetch_assoc();
		
		foreach($_POST['author'] as $v){
			q("
				INSERT INTO `books2books_author` SET
				`author_id` = '".stringAll($v)."',
				`book_id`   = '".stringAll($row2['id'])."'
			");
		}
		
		$_SESSION['info'] = 'Товар был добавлен';
		header('Location: /admin/books');
		exit();
	}
}

$author = q("
	SELECT *
	FROM `books_author`
	ORDER BY `author` 
");
