<?php

########### 5 лучших официантов ###########

	$waiters = q("
		SELECT `weiter_name` , 
		COUNT( `weiter_name` )
		FROM `orders`
		GROUP BY `weiter_name`
		ORDER BY COUNT( `weiter_name` ) DESC
	");


/*
	$waiters = q("
		SELECT `weiter_name` ,                // Выбираем столбец "weiter_name"
		COUNT( `weiter_name` ) 	              // Подсчитываем количество строк в столбце
		FROM `orders`			              // Из таблицы `orders`
		GROUP BY `weiter_name`  			  // Группирем результат по именам
		ORDER BY COUNT( `weiter_name` ) DESC  // Сортируем результат в порядке убывания
	");

*/