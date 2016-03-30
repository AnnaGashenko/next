<?php

	$page = ($_GET['page']);
	$page_num = !isset($_GET['page_num']) || ($_GET['page_num'] <= 0) ?  1 : (int)$_GET['page_num'];
	$module = stringAll($_GET['module']);

	      //////////////////////////////////
		 /////// BLOCK CHAT MESSAGE ///////
	    //////////////////////////////////


	# Получаем все сообщение
	$result = q("
			SELECT *
			FROM `chat`
			ORDER BY `id`
	");		
	# Получаем максимальный id в таблице
	$maxId = q("
		SELECT MAX(id) 
		FROM `chat`
	");	
	$rowId = $maxId->fetch_assoc();
	# Записываем максиимальный id в сессию (id последнего сообщения) 
	$_SESSION['chat-id'] = $rowId['MAX(id)'];


	// перед добавление нового пользователя проверяем, не существует ли уже такой пользователь  
	$res = q("
		SELECT `user_id`
		FROM `online`
		WHERE `user_id` = '".(int)$_SESSION['user']['id']."'
	");

	// если пользователь существует обновляем данные
	if($res->num_rows) {
		q("
			UPDATE `online`
			SET `date_active` = NOW()
			WHERE `user_id` = '".(int)$_SESSION['user']['id']."'
		");
	// если пользователь не существует вставляем данные
	} else {
		$insert = q("
			INSERT INTO `online` SET
			`user_id` = '".(int)$_SESSION['user']['id']."',
			`user_login` = '".stringAll($_SESSION['user']['login'])."',
			`date_active` = NOW()
		");
		# Получаем максимальный id в таблице
		$maxId = q("
			SELECT MAX(id) 
			FROM `online`
		");
		$rowId = $maxId->fetch_assoc();
		# Записываем максиимальный id в сессию (id последнего пользователя) 
		$_SESSION['online-id'] = $rowId['MAX(id)'];
	}	

	// после того как время онлайн истекло, удаляем пользователя из таблицы онлайн
	q("
		DELETE FROM `online`
		WHERE `date_active` < NOW() - INTERVAL 1 MINUTE
	");


      //////////////////////////////////
	 /////// BLOCK WHO ONLINE /////////
    //////////////////////////////////

// Подсчитываем общее количество пользователей "онлайн"
$res_count = q("
	SELECT 
	COUNT('*') 
	FROM `online`
");

$row_count = $res_count->fetch_assoc();
// записываем количество в переменную
$count = $row_count["COUNT('*')"];

// Получает всех пользователей из таблицы "online"
$res_online = q("
	SELECT *
	FROM `online`
");
