<?php


//Обработка регистрации
if(isset($_POST['login'],$_POST['password'],$_POST['email'],$_POST['age'])){
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
	
	if(mb_strlen($_POST['password']) < 7){
		$errors['password'] = 'Пароль должен быть длинее 6-х символов';
	}
	// Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Вы не заполнили поле e-mal';
	}
	
	// Делаем проверку существует ли такой пользователь в БД
	if(!count($errors)){
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `login` = '".stringAll($_POST['login'])."'
			LIMIT 1
		"); 
		// mysqli_num_rows - возвращает количество найденых строк
		// Если найдет запись (true), то значит такой логин уже занят, если нет (false) - свободен (нет записи)
		if(mysqli_num_rows($res)) {
			$errors['login'] = 'Такой логин уже занят';
		}
		
		// Проверяем уникальность email
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `email` = '".stringAll($_POST['email'])."'
			LIMIT 1
		"); 
		//mysqli_num_rows - возвращает количество найденых строк
		// Если найдет запись (true), то значит такой логин уже занят, если нет (false) - свободен (нет записи)
		if(mysqli_num_rows($res)) {
			$errors['email'] = 'Такой email уже занят';
		}
	}
	
	// Дефолтное фото при регистрации
	$avatar['small'] = '/uploaded/avatar/20x20/default_small.png';
	$avatar['big']   = '/uploaded/avatar/100x100/default_large.png';

	
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		q("
			INSERT INTO `users` SET
			`login`             = '".stringAll($_POST['login'])."',
			`password`          = '".myHash($_POST['password'])."',
			`email`             = '".stringAll($_POST['email'])."',
			`age`               = ".(int)$_POST['age'].",
			`hash`              = '".myHash($_POST['login'].$_POST['email'])."',
			`avatar_small` = '".stringAll($avatar['small'])."',
			`avatar_big`   = '".stringAll($avatar['big'])."',
			`date_registration` = NOW()
		"); 
		
		// Получаем наш id
		// mysqli_insert_id - возвращает автоинкремент id записи которая только, что добавилась при регистрации
		// Если запишется пользователь под номером id = 15, то в $id запишеться 15
		$id = mysqli_insert_id($link);
		
		//Записываем переменную в сессию, чтобы сохранить ее между страницами
		$_SESSION['regok'] = 'OK';
		
		Mail::$to = $_POST['email'];
		Mail::$subject = 'Вы зарегестрировались на сайте ';
		//Указывает полный путь к нашему сайту, к странице с активацией
		Mail::$text = '
			То пройдите по ссылке для активации вашего аккаунта: '.Core::$DOMAIN.'index.php?module=cab&page=activate&id='.$id.'&hash='. myHash($_POST['login'].$_POST['email']).'
		';
		// Отправляем письмо
		Mail::send();
		// В переменную $hash записываем хешированные данные пользователя (Логин и Возраст)
		
		// Делаем переадресацию на эту же страницу
		header("Location: /cab/registration");
		exit();
		

	}
}














