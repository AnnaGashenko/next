<?php
                                               /*УДАЛЕНИЕ КНИГ*/
// Удаляем нескольких товаров сразу
if(isset($_POST['delete'], $_POST['ids'])){
	// Обрабатываем все числа массива (int)
	foreach($_POST['ids'] as $k => $v){
		$_POST['ids'][$k] = (int)$v;
	}
	
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `books`
		WHERE `id` IN (".$ids.")
	");
	// Удаляем информацию с таблицы books2books_author
	q("
		DELETE FROM `books2books_author`
		WHERE `book_id` IN (".$ids.")
	");
	
	$_SESSION['info'] = 'Книги были удалены';
	header("Location: /admin/books");
	exit();
} 

// Удаляем одну книгу
// Принимает параметры переменной $action созданной в main.tpl
if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
	q("
		DELETE FROM `books`
		WHERE `id` = ".(int)$_GET['id']."
	");
	// Удаляем информацию с таблицы books2books_author
	q("
		DELETE FROM `books2books_author`
		WHERE `book_id` = ".(int)$_GET['id']."
	");
	
	$_SESSION['info'] = 'Книга была удалена';
	header("Location: /admin/books");
	exit();
}


//Передаем переменную между страницами 
if(isset($_SESSION['info'])){
	// При этом прежде, чем ее удалить, запишем ее содержание
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}

// Запрос к Базе данных - Выводим все книги
$books = q("
	SELECT *
	FROM `books`
	ORDER BY `id` DESC
");


/*
implode - Объединяет элементы массива в строку, через разделитель
Входящие прараметры: массив
Выходящие параметры: строка
*/