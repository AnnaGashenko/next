<?php

########### 5 популярных блюд ###########

	// Получаем среднее значение по числу заказа блюд
	// и для каждой строки в этой группе вычислить среднее количество
	$popular = q("
		SELECT  `dish_id` , 
		AVG(  `count` ) 
		FROM  `orders2dishes` 
		GROUP BY  `dish_id` 
		ORDER BY AVG(  `count` ) DESC 
		LIMIT 0,5
	");

	$ids = array();
	while($row = $popular->fetch_assoc()) {
		$ids[] = $row['dish_id'];
	}
	
	$ids = implode(',',$ids);

    // Вытаскиваем все блюда из заказа №1
    $dishes = q("
		SELECT *
		FROM `dishes`
		WHERE `id` IN (".$ids.")		
	");



