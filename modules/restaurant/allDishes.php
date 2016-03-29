<?php
	// Запрос к Базе данных - Выводим все заказы
	$dishes = q("
		SELECT *
		FROM `dishes`
		ORDER BY `id`
	 ");