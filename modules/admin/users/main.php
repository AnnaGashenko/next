<?php

// Запрос к Базе данных - Выводим всех пользователей
$users = q("
	SELECT *
	FROM `users`
	ORDER BY `login` ASC
");


// Поиск пользователей

if(isset($_GET['submit_search'],$_GET['search'])){
	$search = q("
		SELECT *
		FROM `users`
		WHERE `login` LIKE '%".stringAll($_GET['search'])."%'
	");
	if(!mysqli_num_rows($search)){
		$_SESSION['info'] = 'Пользователь не найден!';
		header("Location: /admin/users");
		exit();	
	}
}


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