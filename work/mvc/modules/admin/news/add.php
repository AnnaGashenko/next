<?php

if(isset($_POST['add'],$_POST['text'],$_POST['cat'],$_POST['description'],$_POST['title'])) {

	foreach($_POST as $k=>$v) {
		$_POST[$k] = trim($v);
	}

	q("
		INSERT INTO `news` SET
		`cat`         = '".es($_POST['cat'])."',
		`title`       = '".es($_POST['title'])."',
		`text`        = '".es($_POST['text'])."',
		`description` = '".es($_POST['description'])."',
		`date`        = NOW()
	");

	$_SESSION['info'] = 'Запись была добавлена';
	header('Location: index.php?module=news');
	exit();
}
