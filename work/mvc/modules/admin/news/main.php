<?php
Core::$META['title'] = 'Новый параметр';
Core::$CSS[] = '<link type="text/css" rel="stylesheet" href="/css/zzep_style.css">';

if(isset($_POST['delete'])) {
	foreach($_POST['ids'] as $k=>$v) {
		$_POST['ids'][$k] = (int)$v;
	}

	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `news`
		WHERE `id` IN (".$ids.")
	");
	$_SESSION['info'] = 'Новости были удалены';
	header("Location: /news");
	exit();
}

if(isset($_GET['key1'],$_GET['key2']) && $_GET['key1'] == 'delete') {
	q("
		DELETE FROM `news`
		WHERE `id` = ".(int)$_GET['key2']."
	");

	$_SESSION['info'] = 'Новость была удалена';
	header("Location: /news");
	exit();
}



$news = q("
	SELECT *
	FROM `news`
	ORDER BY `id` DESC
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}
