<?php


if(isset($_GET['id'])){
	// Запрос к Базе данных - Выводим все новости
	$res = q("
		SELECT *
		FROM `goods`
		WHERE `id`    = '".intAll($_GET['id'])."'
		LIMIT 1
	 ");
}

if($res->num_rows){
	$row = $res->fetch_assoc();
}
