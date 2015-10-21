<?php
if(isset($_GET['id'])){
	$res = q("
		SELECT *
		FROM `books`
		WHERE `id` = '".intAll($_GET['id'])."'
		LIMIT 1
	");
	$row = $res->fetch_array();

	$res2 = q("
		SELECT *
		FROM `books2books_author`
		WHERE `book_id` = '".intAll($_GET['id'])."'		
	");
	
	$ids = array();
	while($row2 = $res2->fetch_assoc()) {
		$ids[] = $row2['author_id'];
	}
	
	$ids = implode(',',$ids);
		
	$res3 = q("
		SELECT *
		FROM `books_author`
		WHERE `id` IN (".$ids.")	
	");
}