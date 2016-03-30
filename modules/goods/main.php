<?php

// Запрос к Базе данных - Выводим все товары
$goods = q("
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
 ");

$res = q("
	SELECT *
	FROM `goods_cat`
	ORDER BY `id` DESC
");
