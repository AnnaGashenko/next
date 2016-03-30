<?php

// Обработка комментария
if(isset($_POST['reviews_text'])){
    
	// Создаем массив с ошибками
	$errors = array();

	if(empty($_POST['reviews_text'])){
		$errors['reviews_text'] = 'Вы не ввели текст';
	}
	
	// Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `reviews` SET
			`reviews_login` = '".stringAll($_SESSION['user']['login'])."',
			`reviews_email` = '".stringAll($_SESSION['user']['email'])."',
			`reviews_text`  = '".stringAll($_POST['reviews_text'])."',
			`date`  = NOW()
		");

		$new_mess = q("
			SELECT *
			FROM `reviews`
			WHERE `id` > '".(int)$_SESSION['id']."'
			
		");

		$output = array();

		// проверяем есть ли новые записи в БД 
		if($new_mess->num_rows) {
			while($row_mess = $new_mess->fetch_assoc()) {	
				$output[] = $row_mess;
				// записываем последнюю запись в сессию
				$_SESSION['id'] = $row_mess['id'];
			}	
		} 	
		
		// возвращаем результат в виде объекта
		echo json_encode($output);
		exit();

	}
	exit();
}


