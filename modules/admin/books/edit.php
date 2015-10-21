<?php


$author = q("
	SELECT *
	FROM `books_author`
	ORDER BY `author`
");

// Делаю запрос, чтобы получить всех авторов этой книги
$books2books_author = q("
	SELECT *
	FROM `books2books_author`
	WHERE `book_id` = ".(int)$_GET['id']."
");


$ids = array();
while($row3 = $books2books_author->fetch_assoc()) {
	$ids[] = $row3['author_id'];
}

//В поля формы нужно подставить данные из БД для их редакатирования
$books = q("
	SELECT *
	FROM `books`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");
$row = $books->fetch_assoc();

// Проверяем существует ли данная запись (если ввести в адреснуб строку id новости которой нет)
if(!$books->num_rows) {
	$_SESSION['info'] = 'Данного товара не существует!';
	header("Location: /admin/books");
	exit();
}


if(isset($_POST['edit'], $_POST['title'], $_POST['author'], $_POST['text'], $_POST['cod'], $_POST['price'])){

	
	// Создаем массив с ошибками
	$errors = array();
	
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
	if(empty($_POST['author'])){
		$errors['author'] = 'Вы не выбрали автора';
	}
	if(empty($_POST['text'])){
		$errors['text'] = 'Вы не ввели текст';
	}
	if(empty($_POST['cod'])){
		$errors['cod'] = 'Вы не ввели код товара';
	}
	if(empty($_POST['price'])){
		$errors['price'] = 'Вы не ввели цену товара';
	}
	
	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		if(isset($book['small'], $book['big'])) {
			$small = ",`book_small` = '".stringAll($book['small'])."'"; 
			$big   = ",`book_big`   = '".stringAll($book['big'])."'"; 
		} 
		q("
			UPDATE `books` SET
		    `title`       = '".stringAll($_POST['title'])."',
			`text`        = '".stringAll($_POST['text'])."',
			`description` = '".stringAll($_POST['description'])."',
			`cod`         = '".(int) $_POST['cod']."',
			`price`       = '".(int) $_POST['price']."'
			".(isset($small) ? $small : '')."
			".(isset($big) ? $big : '')."
			WHERE `id`    = ".(int)$_GET['id']."
		");
		// Удаляем все из таблицы books2books_author по выбранной книге
		q("
			DELETE FROM `books2books_author`
			WHERE `book_id`    = ".(int)$_GET['id']."
		");
		// Записываем выбранных авторов
		foreach ($_POST['author'] as $v) {
			q("
				INSERT INTO `books2books_author` SET
				`author_id`  = '".(int)$v."',
				`book_id`    = ".(int)$_GET['id']."
			");
		}		
		
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /admin/books');
		exit();
	}
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