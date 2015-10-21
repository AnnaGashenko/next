<?php
// Авторизация на сайте
if(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'])){
	header("Location: /");
    exit();
}

if(isset($_POST['login'],$_POST['pass'])) {
	$res = q("
		SELECT *
		FROM `users`
		WHERE `login`    = '".stringAll($_POST['login'])."'
			AND `password` = '".myHash($_POST['pass'])."'
			AND `active` = 1
	    LIMIT 1
	");
	// Если результат совпадает 
	if(!$res->num_rows){
		echo 'no';	
	} else {
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = $res->fetch_assoc();
		// Создаем переменную которая говорит, все отлично мы авторизировались
		$status = 'OK';
		// Авто-авторизация
		// Если была поставлена галочка
		if(isset($_POST['autoauth'])) {
			// Записываем в переменную наш HASH = ID + LOGIN + EMAIL
			$hash = myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email'])	;
			// Создаем куки и записываем наш $hash и id в COOKIE
			setcookie('auto_autoauth_hash', $hash, time()+3600*24*30*12,'/');
			setcookie('auto_autoauth_id', $_SESSION['user']['id'], time()+3600*24*30*12,'/');		
			// Обновляем данные в БД
			// В последствии мы будем искать по этой строке (когда она придет из куки) нужного пользователя.
			$res = q("
				UPDATE `users` SET
				`user_agent`  = '".stringAll($_SERVER['HTTP_USER_AGENT'])."',
				`ip`          = '".(int)$_SERVER['REMOTE_ADDR']."',
				`hash`        = '".$hash."'			
				WHERE `id` = ".(int)$_SESSION['user']['id']."	
			");
		}	
	}
	exit();
}





/*

if(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'])){
	header("Location: /");
    exit();
}

if(isset($_POST['login'],$_POST['pass'])) {
	$res = q("
		SELECT *
		FROM `users`
		WHERE `login`    = '".stringAll($_POST['login'])."'
			AND `password` = '".myHash($_POST['pass'])."'
			AND `active` = 1
	    LIMIT 1
	");
	// Если результат совпадает 
	if($res->num_rows){
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = $res->fetch_assoc();
		// Создаем переменную которая говорит, все отлично мы авторизировались
		$status = 'OK';
		// Авто-авторизация
		// Если была поставлена галочка
		if(isset($_POST['autoauth'])) {
			// Записываем в переменную наш HASH = ID + LOGIN + EMAIL
			$hash = myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email'])	;
			// Создаем куки и записываем наш $hash и id в COOKIE
			setcookie('auto_autoauth_hash', $hash, time()+3600*24*30*12,'/');
			setcookie('auto_autoauth_id', $_SESSION['user']['id'], time()+3600*24*30*12,'/');		
			// Обновляем данные в БД
			// В последствии мы будем искать по этой строке (когда она придет из куки) нужного пользователя.
			$res = q("
				UPDATE `users` SET
				`user_agent`  = '".stringAll($_SERVER['HTTP_USER_AGENT'])."',
				`ip`          = '".(int)$_SERVER['REMOTE_ADDR']."',
				`hash`        = '".$hash."'			
				WHERE `id` = ".(int)$_SESSION['user']['id']."	
			");
		}		
	} else {
		$error = 'Нет пользователя с таким логином и паролем';
	}
}




// Авторизация на сайте
if(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'])){
	header("Location: /");
    exit();
}
if(isset($_POST['login'], $_POST['pass'])) {
	$res = q("
		SELECT *
		FROM `users`
		WHERE `login`    = '".stringAll($_POST['login'])."'
			AND `password` = '".myHash($_POST['pass'])."'
			AND `active` = 1
	    LIMIT 1
	");
	// Если результат совпадает 
	if(!$res->num_rows){
		echo 0;
	} else {
		echo 1;
	}		
	exit();
}










*/