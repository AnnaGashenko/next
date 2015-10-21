<?php


// Например у человек не авторизирован и пытается вручную войти в кабинет пользователя через адресную строку
if(!isset($_SESSION['user'])) {
	if(($_GET['module'] == 'cab') && ($_GET['page'] == 'user_edit')) { 
		// Делаем переадресацию на авторизацию
		header("Location: /cab/auth");
		exit();
	}
}

// Если человек авторизирован сохраняем его данные при переходе между страницами
if(isset($_SESSION['user'])) {
	// Обновляем данные с БД
	$res = q("
		SELECT *
		FROM `users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	// Перезаписываем свежие данные в сессию
	$_SESSION['user'] = $res->fetch_assoc();
	// Обновляем данные последней активности пользователя с БД
	q("
		UPDATE `users` SET
		`date_active` = NOW()
		WHERE `id` = ".stringAll($_SESSION['user']['id'])."
	");

	// Проверем не забанин ли он (может уже в БД сменили active на 2 и забанили пользователя )
	if($_SESSION['user']['active'] != 1) {
		// Чтобы не зацикливать вместо 			header("Location: index.php?module=cab&page=exit");
		include './modules/cab/exit.php'; 
		exit();
	}

// Авто-авторизация (когда нет сессии - человек сам не авторизировался) или сессия умерла
// Например пользователь заходил на сайт вчера, авторизировался, пришел сегодня, но сессия уже умерла
// По-этому проверяется существование кук и если они совпадают, мы его авто-авторизируем
// Но не для всех, если например у человека поменялся ip или браузер или hash не подошел, убиваем куки и сессию, чтоб постоянно не происходил запрос
} elseif(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id']) ){
		// Обновляем данные с БД (Сравниваем данные куки с данными в БД)
		$res = q("
			SELECT *
			FROM `users`
			WHERE `id`           = ".(int)$_COOKIE['auto_autoauth_id']."
				AND	`hash`       = '".stringAll($_COOKIE['auto_autoauth_hash'])."'
			LIMIT 1
		");
		if($res->num_rows){
			$row = $res->fetch_assoc();
			if($row['user_agent'] == stringAll($_SERVER['HTTP_USER_AGENT']) && $row['ip'] == stringAll($_SERVER['REMOTE_ADDR'])){
				// Храним инфо о пользователе в $_SESSION
				$_SESSION['user'] = $res->fetch_assoc();
			} else {
			// Если данные не совпадают, то удаляем куки и сессию, чтобы повторного запроса не было
			include './modules/cab/exit.php'; 
			exit();
			}
		} else {
			// Если данные не совпадают, то удаляем куки и сессию, чтобы повторного запроса не было
			include './modules/cab/exit.php'; 
			exit();
		}
} 
		
	// Если данные хэша содержаться то автоматически авторизируемся
	// Проверять возможность на автоматическую авторизацию: myHash(ID+LOGIN+EMAIL)
	// авторизируем пользователя  $_SESSION['user'] = mysqli_fetch_assoc($res);
	// Ели такой Hash не существует, то этот Hash необходимо удалить
	// и  БД  для спавнения хранить бонусом: ip, HTTP_USER_AGENT (браузер)
			/*	AND `user_agent` = '".stringAll($_SERVER['HTTP_USER_AGENT'])."'
				AND `ip`         = '".stringAll($_SERVER['REMOTE_ADDR'])."'
				
				
				} elseif(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id']) ){
		// Обновляем данные с БД (Сравниваем данные сессии с данными в БД)
		$res = q("
			SELECT *
			FROM `users`
			WHERE `id`           = ".(int)$_COOKIE['auto_autoauth_id']."
				AND	`hash`       = '".stringAll($_COOKIE['auto_autoauth_hash'])."'
			LIMIT 1
		");
			if(mysqli_num_rows($res)){
				// Храним инфо о пользователе в $_SESSION
				$_SESSION['user'] = mysqli_fetch_assoc($res);
			} else {
				// Если данные не совпадают, то удаляем куки и сессию, чтобы повторного запроса не было
				include './modules/cab/exit.php'; 
				exit();
			} 

*/