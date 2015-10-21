<?php
                                               /*УДАЛЕНИЕ ТОВАРОВ*/
// Удаляем нескольких товаров сразу
if(isset($_POST['delete'], $_POST['ids'])){
	// Обрабатываем все числа массива (int)
	foreach($_POST['ids'] as $k => $v){
		$_POST['ids'][$k] = (int)$v;
	}
	
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `goods`
		WHERE `id` IN (".$ids.")
	");
	
	$_SESSION['info'] = 'Товары были удалены';
	header("Location: /admin/goods");
	exit();
} 

// Удаляем одну новость
// Принимает параметры переменной $action созданной в main.tpl
if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
	q("
		DELETE FROM `goods`
		WHERE `id` = ".(int)$_GET['id']."
	");
	
	$_SESSION['info'] = 'Товар был удален';
	header("Location: /admin/goods");
	exit();
}

//Удаление нескольких записей

//Передаем переменную между страницами 
if(isset($_SESSION['info'])){
	// При этом прежде, чем ее удалить, запишем ее содержание
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}

// Запрос к Базе данных - Выводим все товары
$goods = q("
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
 ");


/*
implode - Объединяет элементы массива в строку, через разделитель
Входящие прараметры: массив
Выходящие параметры: строка
*/