<?php

	// Выводим все заказы за сегодня
	$result = q("
		SELECT *
		FROM `orders`
		WHERE `date` >= CURDATE()
		ORDER BY `id` DESC
	");

	// Подсчитываем итоговую сумму заказов за сегодня
	$OrderTotal = q("
		SELECT SUM( summ_order ) 
		AS OrderTotal
		FROM `orders`
		WHERE  `date` >= CURDATE( )
	");

	//////////// Выводим последние 5 заказов /////////
	$last5orders = q("
		SELECT *
		FROM `orders`
		ORDER BY `id` DESC
		LIMIT 5
	");

	#Получаем максимальный id в таблице
	$maxId = q("
		SELECT MAX(id) 
		FROM `orders`
	");	
	$rowId = $maxId->fetch_assoc();
	#Записываем максиимальный id в сессию (id последнего заказа) 
	$_SESSION['order-id'] = $rowId['MAX(id)'];

	/////////////  5 популярных блюд ///////////////
	// Получаем среднее значение по числу заказа блюд
	// и для каждой строки в этой группе вычислить среднее количество
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


