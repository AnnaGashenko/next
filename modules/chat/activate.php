<?php

if (isset($_GET['hash'], $_GET['id'])) {
// Нужно обновить ячейку active в БД изменить с 0 на 1, там где $hash = hash
	q("
		UPDATE `users` SET
		`active` = 1
		WHERE `id` = ".(int)$_GET['id']."
		AND `hash` = '".stringAll($_GET['hash'])."'
	");
	$info = 'Вы активны на сайте';
} else {
	$info = 'Вы прошли по неверной ссылке';
}