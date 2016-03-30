<?php

// next/news/cat_news?cat=social&page_num=3
// next/module/page
$page = ($_GET['page']);
$page_num = !isset($_GET['page_num']) || ($_GET['page_num'] <= 0) ?  1 : (int)$_GET['page_num'];
$module = stringAll($_GET['module']);
$cat = stringAll($_GET['cat']);


// Определяем общее число сообщений в выбранной категории 
$res = q("
	SELECT 
	COUNT(*) 
	FROM `".$module."`
	WHERE `cat` = '".$cat."'
");
if($res->num_rows) {
	Paginator::$show_pages = 3;
	Paginator::__($page_num,$page,$module,$res); 
			
	$result = q("
		SELECT *
		FROM `".$module."`
		WHERE `cat` = '".$cat."'
		ORDER BY `id`
		LIMIT ".Paginator::$shift.",". Paginator::$num."
	");
}



/*
	// Запрос к Базе данных - Выводим все новости
	$res = q("
		SELECT *
		FROM `news`
		WHERE `cat` = '".stringAll($_GET['cat'])."'
		ORDER BY `id` DESC
		LIMIT 5
	");
		
	// Определяем общее число сообщений в выбранной категории 
	$res_count = q("
		SELECT 
		COUNT(*) 
		FROM `news`
		WHERE `cat` = '".stringAll($_GET['cat'])."'
	");
	// проверяем есть ли в категории хоть одна запись
	if($res_count->num_rows) {
		$row2 = $res_count->fetch_array();
		$count = $row2[0];
		$limit = 2; // сколько записей выводить на странице
		// разбиваем постранично
		// узнаем сколько страниц получается
		$count_pages = ceil($count/$limit);
		// wtf($count_pages);
	}
	
	

// Считаем сколько у нас записей в БД
    if($count = $res->num_rows) {
		// сколько записей выводить на странице
		$limit = 2;
		// Для начала определим, сколько всего получится страниц. 
		// Для этого надо поделить общее число записей на количество записей выводимых на одной странице
		// и округлить результат в большую сторону. Таким округлением занимается в пхп функция ceil()
		$count_pages = ceil($count/$limit);
	}
*/

/*	if($count = $res->num_rows) {
			$limit = 2;// Количество записей на странице
			// разбиваем постранично
			// узнаем сколько страниц получается
			$count_pages = ceil($count/$limit);
			if (isset($_GET['num']) ? $num=($GET['num'] * $limit - $limit) : $num=0)
			$res2 = q("
				SELECT *
				FROM `news` 
				LIMIT $num, $limit
			");
	}
*/