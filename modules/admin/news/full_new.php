<?php


if(isset($_GET['id'])){
	// Запрос к Базе данных - Выводим все новости
	$res = q("
		SELECT *
		FROM `news`
		WHERE `id`    = '".intAll($_GET['id'])."'
		LIMIT 1
	 ");
}
// Если результат совпадает, записываем его в переменную $row
if($res->num_rows){
	$row = $res->fetch_assoc();
}
