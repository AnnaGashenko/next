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
	if(mysqli_num_rows($res)){
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = mysqli_fetch_assoc($res);
		// Создаем переменную которая говорит, все отлично мы авторизировались
		$status = 'OK';
				
		// Авто-авторизация
		// Если была поставлена галочка
		if(isset($_POST['autoauth'])) {
			$hash = myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email'])	;
			setcookie('auto_autoauth_hash', $hash, time()+3600*24*30*12,'/');
			setcookie('auto_autoauth_id', $_SESSION['user']['id'], time()+3600*24*30*12,'/');		
			$res = q("
				UPDATE `users` SET
				`user_agent`  = '".stringAll($_SERVER['HTTP_USER_AGENT'])."',
				`ip`          = '".stringAll($_SERVER['REMOTE_ADDR'])."',
				`hash`        = '".$hash."'			
				WHERE `id` = ".stringAll($_SESSION['user']['id'])."	
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
	if(mysqli_num_rows($res)){
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = mysqli_fetch_assoc($res);
		// Создаем переменную которая говорит, все отлично мы авторизировались
		$status = 'OK';
		
		// Авто-авторизация
		// Если была поставлена галочка
		if(isset($_POST['autoauth'])) {
			// Обновляем данные user_agent | ip | hash
			// Данные берем из сессии
			$res = q("
				UPDATE `users` SET
				`user_agent`  = '".stringAll($_SERVER['HTTP_USER_AGENT'])."',
				`ip`          = '".stringAll($_SERVER['REMOTE_ADDR'])."',
				`hash`        = '".myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email'])."'			
				WHERE `id`    = ".(int)$_SESSION['user']['id']."	
			");
			$res = q("
				SELECT *
				FROM `users`
				WHERE `id`     = ".(int)$_SESSION['user']['id']."	
				LIMIT 1
			");
			if(mysqli_num_rows($res)){
				// Храним новые данные о пользователе в $_SESSION
				$_SESSION['user'] = mysqli_fetch_assoc($res);
 			 
				// Устанавливаем куки
				setcookie('auto_autoauth_hash', $_SESSION['user']['hash'], time()+3600*24*30*12,'/');
				setcookie('auto_autoauth_id', $_SESSION['user']['id'], time()+3600*24*30*12,'/');
			} else {
				header("Location: /cab/auth");
				exit();
			}
		}
	} else {
		$error = 'Нет пользователя с таким логином и паролем';
	}
}


