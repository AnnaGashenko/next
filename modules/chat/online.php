<?php

// количество секунд когда пользователь считается в онлайне
$online_time = 60*20; // 20 min
// ip user's
$ip = $_SESSION['user']['ip'];
$ip = ip2long($ip);
$date = time();
$delete_date = $date - $online_time;

$res = q("
	SELECT `id`
	FROM `online`
	WHERE `ip` = '$ip'
");

if($res->num_rows) {
	q("
		UPDATE `online`
		SET `date`='$date'
		WHERE `ip` = '$ip'
	");
} else {
	q("
		INSERT INTO `online` SET
		`ip` = '".(int)$ip."',
		`date` = '".(int)$date."'
	");
}

// после того как время онлайн истекло, удаляем пользователя из таблицы онлайн

$res_delete = q("
	DELETE FROM `online`
	WHERE `date` < '$delete_date'
");

// count who "online"
$res_count = q("
	SELECT 
	COUNT('*') 
	FROM `online`
");
$row_count = $res_count->fetch_assoc();

$count = $row_count["COUNT('*')"];

