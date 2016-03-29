<?php

########### Список блюд в заказе ###########
if(isset($_GET['id'])){
	// Вывести все из таблицы "orders2dishes" где номер заказа = 1
	// Получаем все блюда в заказе
	$orders = q("
		SELECT *
		FROM `orders2dishes`
		WHERE `order_id` = '".intAll($_GET['id'])."'
	");

	$ids = array();
	while($row = $orders->fetch_assoc()) {
		$ids[] = $row['dish_id'];
	}
	
	$ids = implode(',',$ids);

    // Вытаскиваем все блюда из заказа №1
    $dishes = q("
		SELECT *
		FROM dishes,orders2dishes
		WHERE dishes.id = orders2dishes.dish_id
		AND dishes.id IN (".$ids.")	
		AND orders2dishes.order_id = '".intAll($_GET['id'])."'	
	");
}