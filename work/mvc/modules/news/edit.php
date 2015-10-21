<?php
if(isset($_POST['ok'],$_POST['text'],$_POST['cat'],$_POST['description'],$_POST['title'])) {

	foreach($_POST as $k=>$v) {
		$_POST[$k] = trim($v);
	}

	q("
		UPDATE `news` SET
		`cat`         = '".es($_POST['cat'])."',
		`title`       = '".es($_POST['title'])."',
		`text`        = '".es($_POST['text'])."',
		`description` = '".es($_POST['description'])."',
		`date`        = NOW()
		WHERE `id` = ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Запись была изменена';
	header('Location: /news');
	exit();
}

$news = q("
	SELECT *
	FROM `news`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");

if(!$news->num_rows) {
	$_SESSION['info'] = 'Данной новости не существует!';
	header("Location: /news");
	exit();
}

$row = $news->fetch_assoc();

if(isset($_POST['title'])) {
	$row['title'] = $_POST['title'];
}

