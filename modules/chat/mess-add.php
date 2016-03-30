<?php
// Обработка комментария
if(isset($_POST['chat_message'])){	
   
	// Создаем массив с ошибками
	$errors = array();

	if(empty($_POST['chat_message'])){
		$errors['chat-error'] = 'Вы не ввели текст';
	}
	
	// Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		
		q("
			INSERT INTO `chat` SET
			`ChatUserId` = '".stringAll($_SESSION['user']['login'])."',
			`chat_message`  = '".stringAll($_POST['chat_message'])."',
			`date`  = NOW()
		");
	}
	exit();
}
