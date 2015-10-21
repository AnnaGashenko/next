<?php
												   /*УДАЛЕНИЕ НОВОСТЕЙ*/												   
												   
// Удаляем несколько новостей сразу
if(isset($_POST['delete'], $_POST['ids'])){
	// Обрабатываем все числа массива (int)
	foreach($_POST['ids'] as $k => $v){
		$_POST['ids'][$k] = (int)$v;
	}
	
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `news`
		WHERE `id` IN (".$ids.")
	");
	
	$_SESSION['info'] = 'Новости были удалены';
	header("Location: /admin/news");
	exit();
} 
	
// Удаляем одну новость
// Принимает параметры переменной $action созданной в main.tpl
if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
	q("
		DELETE FROM `news`
		WHERE `id` = ".(int)$_GET['id']."
	");
	
	$_SESSION['info'] = 'Новость была удалена';
	header("Location: /admin/news");
	exit();
}

//Передаем переменную между страницами 
if(isset($_SESSION['info'])){
	// При этом прежде, чем ее удалить, запишем ее содержание
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}

// Запрос к Базе данных - Выводим все новости
$res = q("
	SELECT *
	FROM `news`
	ORDER BY `id` DESC
 ");

/*
implode - Объединяет элементы массива в строку, через разделитель
Входящие прараметры: массив
Выходящие параметры: строка
*/