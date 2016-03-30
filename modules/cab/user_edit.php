<?php
if(isset($_POST['edit'], $_POST['login'], $_POST['email'])){
	
	// Создаем массив с ошибками
 	$errors = array();
	
	if(empty($_POST['login'])){
		$errors['login'] = 'Вы не заполнили поле логин';
	} elseif(mb_strlen($_POST['login']) < 2) {
	// Проверяем на длину
		$errors['login'] = 'Логин слишком короткий';
	}elseif(mb_strlen($_POST['login']) > 16) {
		$errors['login'] = 'Логин слишком длинный';
	}
	
	// Если поле пароль не пустой (т.е. пользователь захотел изменить пароль)
	if(!empty($_POST['password'])){
		if(mb_strlen($_POST['password']) < 7){
			$errors['password'] = 'Пароль должен быть длинее 6-х символов';
		}
	}
	
	//Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Вы не заполнили поле emal';
	}
		
	
	// Проверяем уникальность login
	if($_SESSION['user']['login'] != $_POST['login']) {
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `login` = '".stringAll($_POST['login'])."'
			LIMIT 1
		"); 
		// mysqli_num_rows - возвращает количество найденых строк
		// Если найдет запись (true), то значит такой логин уже занят, если нет (false) - свободен (нет записи)
		if($res->num_rows) {
			$errors['login'] = 'Такой логин уже занят';
		}
	}
	
	// Проверяем уникальность email
	if($_SESSION['user']['email'] != $_POST['email']) {
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `email` = '".stringAll($_POST['email'])."'
			LIMIT 1
		"); 
		if($res->num_rows) {
			$errors['email'] = 'Такой email уже занят';
		}
	}
	
	$photo['small'] = $_SESSION['user']['photo_small'];
	$photo['big']   = $_SESSION['user']['photo_big'];
	
	if($_FILES['file']['error'] == 0) {
		if($temp = Uploader::upload($_FILES['file'],'avatar')) {
			$photo['small'] = Uploader::resize($temp,20,20);
			$photo['big']   = Uploader::resize($temp,100,100);
		} else {
			$errors['file'] = Uploader::$error;
		}
	}

	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		if(!empty($_POST['password'])) {
			$pass = ",`password` = '".myHash($_POST['password'])."'"; 
		}
		
		q("
			UPDATE `users` SET
			`login`    = '".stringAll($_POST['login'])."',
			`email`    = '".stringAll($_POST['email'])."',
			`photo_small` = '".stringAll($photo['small'])."',
			`photo_big`   = '".stringAll($photo['big'])."'
			".(isset($pass) ? $pass : '')."
			WHERE `id` = ".(int)$_SESSION['user']['id']."
		"); 
		  
		$_SESSION['editok'] = 'OK';
		header('Location: /cab/user_edit');
		exit();
	}	
}
	
	
	
//В поля формы нужно подставить данные из БД для их редакатирования
$users = q("
	SELECT *
	FROM `users`
	WHERE `id` = ".(int)$_SESSION['user']['id']."
	LIMIT 1
");

$row = $users->fetch_assoc();
