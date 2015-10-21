<?php
                                               /*УДАЛЕНИЕ КАТЕГОРИЙ*/
// Удаляем нескольких товаров сразу
if(isset($_POST['delete'], $_POST['ids'])){
	// Обрабатываем все числа массива (int)
	foreach($_POST['ids'] as $k => $v){
		$_POST['ids'][$k] = (int)$v;
	}
	
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `news_cat`
		WHERE `id` IN (".$ids.")
	");
	
	$_SESSION['info'] = 'Категории были удалены';
	header("Location: /admin/news/main_cat");
	exit();
} 

// Удаляем одну категорию
// Принимает параметры переменной $action созданной в main.tpl
if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
	q("
		DELETE FROM `news_cat`
		WHERE `id` = ".(int)$_GET['id']."
	");
	
	$_SESSION['info'] = 'Категория была удалена';
	header("Location: /admin/news/main_cat");
	exit();
}

//Удаление нескольких записей

//Передаем переменную между страницами 
if(isset($_SESSION['info'])){
	// При этом прежде, чем ее удалить, запишем ее содержание
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}


// Запрос к Базе данных - Выводим все категории
$res = q("
	SELECT *
	FROM `news_cat`
	ORDER BY `id` DESC
 ");

/*
implode - Объединяет элементы массива в строку, через разделитель
Входящие прараметры: массив
Выходящие параметры: строка
*/