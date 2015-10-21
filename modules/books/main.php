<?php

	// Запрос к Базе данных - Выводим все книги
	$books = q("
		SELECT *
		FROM `books`
		ORDER BY `id` DESC
	 ");
	 
	 
	 
/*	$ids = array();
	while($row = $books->fetch_assoc()) {
		$ids[] = $row['id'];
	}
	
	$ids = implode(',',$ids);
		
	$res2 = q("
		SELECT *
		FROM `books2books_author`
		WHERE `id` IN (".$ids.")	
	");
	
	$id = array();
	while($row2 = $res2->fetch_assoc()) {
		$id[] = $row2['author_id'];
	}
	
	$id = implode(',',$id);
		
	$res3 = q("
		SELECT *
		FROM `books_author`
		WHERE `id` IN (".$id.")	
	");
*/
