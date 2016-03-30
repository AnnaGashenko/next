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

	

		$new_mess = q("
			SELECT *
			FROM `chat`
			WHERE `id` > '".(int)$_SESSION['chat-id']."'
			
		");

		$output = array();

		// проверяем есть ли новые записи в БД 
		if($new_mess->num_rows) {
			while($row_mess = $new_mess->fetch_assoc()) {	
				$output[] = $row_mess;
				// записываем последнюю запись в сессию
				$_SESSION['chat-id'] = $row_mess['id'];
			}	
		} 	
		
		// возвращаем результат в виде объекта
		echo json_encode($output);
		exit();

	}
	exit();
}
