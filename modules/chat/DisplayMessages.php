<?php
	# Получаем новые добавленные записи
	$new_mess = q("
		SELECT *
		FROM `chat`
		WHERE `id` > '".(int)$_SESSION['chat-id']."'	
	");

	$output = array();

	// проверяем есть ли новые записи в БД 
	if($new_mess->num_rows) {
		$i=0;
		while($row_mess = $new_mess->fetch_assoc()) {
		// собираем все записи в массив	
		$output['newMess'][$i] = $row_mess;
		$i++;
		// записываем последнюю запись в сессию
		$_SESSION['chat-id'] = $row_mess['id'];
		}	
	} 

	// обновляем данные "кто онлайн"
	q("
		UPDATE `online`
		SET `date_active` = NOW()
		WHERE `user_id` = '".(int)$_SESSION['user']['id']."'
	");


	// после того как время онлайн истекло, удаляем пользователя из таблицы онлайн
	q("
		DELETE FROM `online`
		WHERE `date_active` < NOW() - INTERVAL 1 MINUTE
	");

	// Получает всех пользователей из таблицы "online"
	$res_online = q("
		SELECT *
		FROM `online`
		WHERE `id` > '".(int)$_SESSION['online-id']."'	

	");

	$i=0;
	while($row = $res_online->fetch_assoc()) {
		// собираем все записи в массив	
		$output['newOnline'][$i] = $row;
		$i++;
		// записываем последнюю запись в сессию
		$_SESSION['online-id'] = $row['id'];
	}	


/*
	// Подсчитываем общее количество пользователей "онлайн"
	$res_count = q("
		SELECT 
		COUNT('*') 
		FROM `online`
	");

	$row_count = $res_count->fetch_assoc();
	// записываем количество в переменную
	$count = $row_count["COUNT('*')"];
	$output['countOnline'] = $count;
*/
// возвращаем результат в виде объекта json_encode
echo json_encode($output);
exit();


/*
###### Если у пельзователь был запрос на новые собщения в чате (срабатывал JS) = он онлайн
АПДЕЙТ юзер СЕТ
последняяактивность = НОВ (ноу)
ГДЕ ай-ди = СЕССИЯ(айди)
 И этот запрос делаешь при каждом запросе на сервер
допустим у тебя раз в 4 секунды посылаться будет за новым сообщением
А онлайн тот, кто проявил активность за последние 30-60 секунд

WHERE `lastactive` > NOW() - INTERVAL 1 MINUTE
Это выборка пользователей, которые проявляли активность последнюю минуту (у которых был апдейт), значит они были в чате
*/