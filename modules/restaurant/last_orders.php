<?php

	// Выводим последние 5 заказов
	$orders = q("
		SELECT *
		FROM `orders`
		ORDER BY `id` DESC
		LIMIT 5
	 ");

	# Получаем максимальный id в таблице
	$maxId = q("
		SELECT MAX(id) 
		FROM `orders`
	");	
	$rowId = $maxId->fetch_assoc();
	# Записываем максиимальный id в сессию (id последнего заказа) 
	$_SESSION['order-id'] = $rowId['MAX(id)'];
