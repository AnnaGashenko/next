<?php

$page = ($_GET['page']);
$page_num = !isset($_GET['page_num']) || ($_GET['page_num'] <= 0) ?  1 : (int)$_GET['page_num'];
$module = stringAll($_GET['module']);


// Определяем общее число сообщений
$res = q("
	SELECT 
	COUNT(*) 
	FROM `".$module."`
");

if($res->num_rows) {
	Paginator::__($page_num,$page,$module,$res); 
			
	$result = q("
		SELECT *
		FROM `".$module."`
		ORDER BY `id` DESC
		LIMIT ".Paginator::$shift.",". Paginator::$num."
	");		
}	