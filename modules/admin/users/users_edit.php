<?php

//Создаем массив с категориями
$active = array(0 => 'Не активен', 1 => 'Открыт', 2 => 'Забанить');


//В поля формы нужно подставить данные из БД для их редакатирования
$users = q("
	SELECT *
	FROM `users`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");
$row = $users->fetch_assoc();

if(isset($_POST['edit'], $_POST['login'], $_POST['active'], $_POST['access'], $_POST['email'])){
	
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
	// Проверяем уникальность login
	if($row['login'] != $_POST['login']) {
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
	}
	
	// Если поле пароль не пустой (т.е. админ захотел изменить пароль)
	if(!empty($_POST['password'])){
		if(mb_strlen($_POST['password']) < 7){
			$errors['password'] = 'Пароль должен быть длинее 6-х символов';
		}
	}
	
	//Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Вы не заполнили поле e-mal';
	}	
	// Проверяем уникальность email
	if($row['email'] != $_POST['email']) {
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
		
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		if(!empty($_POST['password'])) {
			$pass = ",`password` = '".myHash($_POST['password'])."'"; 
		}
		
		q("
			UPDATE `users` SET
			`active`     = '".(int)$_POST['active']."',
			`access`     = '".(int)$_POST['access']."',
			`login`      = '".stringAll($_POST['login'])."',
			`email`      = '".stringAll($_POST['email'])."'
			".(isset($pass) ? $pass : '')."
			WHERE `id`   = ".(int)$_GET['id']."
		"); 
		  
		$_SESSION['info'] = 'Запись была отредактирована';
		header('Location: /admin/users');
		exit();
	}	
}
		
if(isset($_POST['del'])){
	q("
		DELETE FROM `users`
		WHERE `id` = ".(int)$_GET['id']."
	");
	
	$_SESSION['info'] = 'Пользователь был удален';
	header("Location: /admin/users");
	exit();

}



/*wtf($_POST,1);
LIMIT - это оптимизация для более быстрых запросов
Если мы точно знаем, что с таким id у нас всего одна запись
Мы говорим системе, что нам нужно выбрать всего одну запись LIMIT 1
Иначе будут перебирать все записи находящиеся в БД
Процесс:
находит нашу запись -> смотрит LIMIT -> видит что он = 1 -> все обрывает дальше поиск
*/