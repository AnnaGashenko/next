<?php
if(isset($_GET['cat'])){
	// Запрос к Базе данных - Выводим все новости
	$res = q("
		SELECT *
		FROM `books`
		WHERE `cat` = '".stringAll($_GET['cat'])."'
	");
}

/*





q("
	SELECT *
	FROM `books2books_author` 
	JOIN `books` ON (`books`.`id` = `book_id`)
	JOIN `books_author` ON (`books_author`.`id` = `book_auhtor_id`)
");*/

