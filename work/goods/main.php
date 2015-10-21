<?php


// Запрос к Базе данных - Выводим все товары
$goods = mysqli_query($link,"
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
 ") or exit(mysqli_error($link));


                                               /*УДАЛЕНИЕ ТОВАРОВ*/
// Удаляем несколько новостей сразу
if(isset($_POST['delete'])){
	// Обрабатываем все числа массива (int)
	foreach($_POST['ids'] as $k => $v){
		$_POST['ids'][$k] = (int)$v;
	}
	
	$ids = implode(',',$_POST['ids']);
	mysqli_query($link,"
		DELETE FROM `goods`
		WHERE `id` IN (".$ids.")
	") or exit(mysqli_error($link));
	
	$_SESSION['info'] = 'Новости были удалены';
	header("Location: /index.php?module=news");
	exit();
}


// Удаляем одну новость
// Принимает параметры переменной $action созданной в main.tpl
if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
	mysqli_query($link,"
		DELETE FROM `goods`
		WHERE `id` = ".(int)$_GET['id']."
	") or exit(mysqli_error($link));
	
	$_SESSION['info'] = 'Новость была удалена';
	header("Location: /index.php?module=goods");
	exit();
}

//Удаление нескольких записей

//Передаем переменную между страницами 
if(isset($_SESSION['info'])){
	// При этом прежде, чем ее удалить, запишем ее содержание
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}

/*
implode - Объединяет элементы массива в строку, через разделитель
Входящие прараметры: массив
Выходящие параметры: строка
*/