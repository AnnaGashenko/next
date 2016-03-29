<?php

# Получаем новые добавленные записи
	$new_order = q("
		SELECT *
		FROM `orders`
		WHERE `id` > '".(int)$_SESSION['order-id']."'
	");

	$output = array();

	// проверяем есть ли новые записи в БД 
	if($new_order->num_rows) {
		$i = 0;
		while($row_order = $new_order->fetch_assoc()) {
			// собираем все записи в массив	
			$output['newOrder'][$i] = $row_order;
			$i++;
			// записываем последнюю запись в сессию
			$_SESSION['order-id'] = $row_order['id'];
		}	

		# ПОДСЧИТЫВАЕМ ИТОГОВУЮ СУММУ
		$result = q("
			SELECT SUM( summ_order ) 
			AS OrderTotal
			FROM `orders`
			WHERE  `date` >= CURDATE( )
		");
		$i=0;
		while($row = $result->fetch_assoc()) {
			// собираем все записи в массив	
			$output['newSumm'][$i] = $row;
			$i++;
		}

		/////////////  5 популярных блюд ///////////////
		$popular = q("
			SELECT  `dish_id` , AVG(  `count` ) 
			FROM  `orders2dishes` 
			GROUP BY  `dish_id` 
			ORDER BY AVG(  `count` ) DESC ,  `dish_id` DESC 
			LIMIT 0 , 5
		");

		$ids = array();
		while($row = $popular->fetch_assoc()) {
			$ids[] = $row['dish_id'];
		}
		
		$ids = implode(',',$ids);

	    // Вытаскиваем все блюда из заказа
	    $dishes = q("
			SELECT *
			FROM `dishes`
			WHERE `id` IN (".$ids.")		
		");
		$i = 0;
		while($row = $dishes->fetch_assoc()) {
			// собираем все записи в массив	
			$output['popularDishes'][$i] = $row;
			$i++;
		}
	}


	// возвращаем результат в виде объекта json_encode
	echo json_encode($output);
	exit();
