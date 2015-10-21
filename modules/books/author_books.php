<?php
if(isset($_GET['id'])){
	$author = q("
		SELECT *
		FROM `books_author`
		WHERE `id` = '".intAll($_GET['id'])."'
		LIMIT 1
	");
	$row = $author->fetch_assoc();

	$res2 = q("
		SELECT *
		FROM `books2books_author`
		WHERE `author_id` = '".intAll($_GET['id'])."'		
	");
	
	$ids = array();
	while($row2 = $res2->fetch_assoc()) {
		$ids[] = $row2['book_id'];
	}
	
	$ids = implode(',',$ids);		
	$books = q("
		SELECT *
		FROM `books`
		WHERE `id` IN (".$ids.")	
	");
}