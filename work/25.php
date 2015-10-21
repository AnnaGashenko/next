<?php 

// md5 - ХЭШ - кодировка
echo md5('inpost'); // Вывведит 
exit();

// B registration.php подключаем ф-и

// БЫЛО
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		mysqli_query($link,"
		INSERT INTO `users` SET
		`login` = '".mysqli_real_escape_string($link,$_POST['login'])."',
		`password` = '".mysqli_real_escape_string($link,$_POST['password'])."',
		`email` = '".mysqli_real_escape_string($link,$_POST['email'])."',
		`age` = ".(int)$_POST['age']."
		") or exit(mysqli_error($link)); // провяряем запрос на ошибки
	//Записываем переменную в сессию, чтобы сохранить ее между страницами
	$_SESSION['regok'] = 'OK';
	// Делаем переадресацию на эту же страницу
	header("Location: /index.php?module=cab&page=registration");
	exit();

	}

// СТАЛО
	if(!count($errors)){
		q("
		INSERT INTO `users` SET
		`login`    = '".stringAll($_POST['login'])."',
		`password` = '".stringAll($_POST['password'])."',
		`email`    = '".stringAll($_POST['email'])."',
		`age`      = ".(int)$_POST['age']."
		"); 
	//Записываем переменную в сессию, чтобы сохранить ее между страницами
	$_SESSION['regok'] = 'OK';
	// Делаем переадресацию на эту же страницу
	header("Location: /index.php?module=cab&page=registration");
	exit();

	}
 // Например хотим войти в систему
 // Данные к-е записанны в БД при регистрации
 $var = 'inpost';
 $var = md5($var); // f03b82ac6e16b5a56fdcc3a0ed90efdb
 
 // Данные к-е пользователь ввел при входе в свой кабинет
 $var2 = 'inpost';
 $var2 = md5($var); // f03b82ac6e16b5a56fdcc3a0ed90efdb
 if($var == $var2) {
	 // Совпадает хеш-код
 }
 
 // В default.php
 // Создаем функцию для хеширования
 function myHash ($var) {
	 // Соль нужна, чтобы запутать того кто захочет раскодировать хэш 
	$salt_1 = 'ABC'; 
	$salt_2 = 'CBA'; 
	// Прогоняем через ХЭШ с солью
	$var = crypt(md5($var.$salt_1),$salt_2);
	return $var;
 }
// В БД создаем поле activate 
// Делаем проверку, настоящий ли e-mail ввел человек
// Для этого просим его проверить почту и перейти по ссылке
	Mail::$to = $_POST['email'];
	Mail::$subject = 'Вы зарегестрировались на сайте ';
	//Указывает полный путь к нашему сайту, к странице с активацией
	Mail::$text = '
		То пройдите по ссылке для активации вашего аккаунта: '.Core::$DOMAIN.'index.php?module=cab&page=activate&hash='
		. myHash($_POST['login'].$_POST['age']).'
	';
	// Отправляем письмо
	Mail::send();

// В переменную $hash записываем хешированные данные пользователя (Логин и Возраст)
// В registration.php 
	if(!count($errors)){
		q("
			INSERT INTO `users` SET
			`login`    = '".stringAll($_POST['login'])."',
			`password` = '".myHash($_POST['password'])."',
			`email`    = '".stringAll($_POST['email'])."',
			`age`      = ".(int)$_POST['age'].",
			`hash`     = ".myHash($_POST['login'].$_POST['age'])."
		"); 

// В config.php создаем константу полного пути к нашему сайту 
	static $DOMAIN = 'http://next';
	
// Добавляем поле в БД 
    hash | varchar | 255


// Добавляем поле в БД 
 active | tinyint | 1 | По умолчанию 0
 
// activate.php
// Нужно обновить ячейку active в БД изменить с 0 на 1, там где $hash = hash
if (isset($_GET['hash'])) {
	q("
		UPDATE `users` SET
		`active` = 1
		WHERE `hash` = '".stringAll($_GET['hash'])."'
	");
	$info = 'Вы активны на сайте';
} else {
	$info = 'Вы прошли по неверной ссылке';
}


// activate.tpl
?>
<div style="padding:100px">
  <h1><?php echo $info; ?></h1>
</div>

<?php

// В registration.php 
 	// Одинаковых логинов не должно существовать в БД
	// Делаем проверку существует ли такой пользователь в БД
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `login` = '".stringAll($_POST['login'])."'
			LIMIT 1
		"); 
		//mysqli_num_rows - возвращает количество найденых строк
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


// Если мы хотим,чтобы пользовать автоматически авторизировался, после того как он пройдет по ссылки активации
// В registration.php 
// Дописываем id
		То пройдите по ссылке для активации вашего аккаунта: '.Core::$DOMAIN.'index.php?module=cab&page=activate&id='.$id.'&hash='. myHash($_POST['login'].$_POST['age']).'
		
// Получаем наш id
// mysqli_insert_id - возвращает автоинкремент id записи которая только, что добавилась при регистрации
//Если запишется пользователь под номером id = 15, то в $id запишеться 15
$id = mysqli_insert_id($link);


// activate.php
// Добавляем  $_GET['id'] и WHERE `id` = ".(int)$_GET['id']."

if (isset($_GET['hash'], $_GET['id'])) {
// Нужно обновить ячейку active в БД изменить с 0 на 1, там где $hash = hash
	q("
		UPDATE `users` SET
		`active` = 1
		WHERE `id` = ".(int)$_GET['id']."
			AND `hash` = '".stringAll($_GET['hash'])."'
	");
	$info = 'Вы активны на сайте';
} else {
	$info = 'Вы прошли по неверной ссылке';
}

//$_GET['hash'] берем с 
// То пройдите по ссылке для активации вашего аккаунта: '.Core::$DOMAIN.'index.php?module=cab&page=activate&hash='. myHash($_POST['login'].$_POST['age']).'


// На почту приходит файл с сылкой для активации путь: tmp - !sendmail
// Открываем письмо, корируем ссылку и переходим по ней
// В БД в поле active должно измениться с 0 на 1


// Создаем авторизацию на сайте
// Создаем файл auth.php и auth.tpl
// Авторизация на сайте
// Мы должны убедиться, что пользователь с таким логином и паролем существует на сайте
if (isset($_POST['login'],$_POST['password'])) {
	// делаем запрос к БД на выборку
	$res = q("
		SELECT *
		FROM `users`
		WHERE `login`    = '".stringAll($_POST['login'])."
			AND `password` = '".myHash($_POST['password'])."'
			AND `active` = 1
	    LIMIT 1
	");
	if(mysqli_num_rows($res)){
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = mysqli_fetch_assoc($res);
		// Создаем переменную которая говорит, все отлично мы авторизировались
		$status = 'OK';
		
	} else {
		// Если человек неправильно ввел данные
		$error = 'Нет пользователя с таким логином и паролем';
	}

}
			          клиент нам отправляет данные
	||||||||||  -------------------------------------->      ||||||||||
	||КЛИЕНТ||   мы  ему пишем: ОК вы зарегестрированы       ||СЕРВЕР||
	||||||||||  <--------------------------------------      ||||||||||

- Пользователь нам может передать такие данные:
1. GET 
2. POST
3. COOKIE
- Нам нужно один раз запомнить логин и пароль и хранить его между страницами
-- Используем COOKIE 
1. Сервер должен проверить, верны ли куки, совпадают ли они
В куках содержится сессия авторизации (id)
- клиент передал нам куки --> сервер проверил, что такой индитификатор авторизациисуществует
--> значит пользователь авторизирован
2. В COOKIE содержится ключ сессии
- создаем файл temp.php -> посмотрим что у нас содержится в куки
[PHPSESSID] => uj71nt751vhhd1qshfggtvc175
		// Храним инфо о пользователе в $_SESSION
		$_SESSION['user'] = mysqli_fetch_assoc($res);
3. Сесия - это персональная инфо конкретного пользователя

//auth.php
// Авторизация на сайте
if (isset($_POST['login'],$_POST['pass'])) {
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
	} else {
		$error = 'Нет пользователя с таким логином и паролем';
	}
}

//auth.tpl
// Делаем проверку и выводим ошибку, если проверку не прошел
?>
<div style="padding:100px">
<?php if(!isset($status) || $status != 'OK')  {echo @$error; ?>
  <form action="" method="post">
    Login: <input name="login" type="text"><br>
    Pass: <input name="password" type="password"><br>
    <input type="submit" name="submit" value="Войти"
  </form>
  <?php } else { ?>
  	Поздравляю, вы авторезированы
  <?php } ?>
</div>

<?php 
// Смотрим, что записалось в $_COOKIE и $_SESSION
// Открываем файл next/temp.php
// temp.php
session_start();
echo '<pre>';
print_r($_COOKIE);
print_r($_SESSION);
echo '</pre>';

// Создаем в БД уровень доступа
// access | tinyint | 1 | По умолчанию -> как определено -> 0
// Убиваем сесию и делаем переадресацию на главную
// создаем exit.php и exit.tpl(пустая)
//  exit.php
// Убиваем сесию
session_unset();
session_destroy();
//делаем переадресацию на главную
header('Location: /');
exit();

//auth.php
// можем сделать доступ к какой-то странице, только у кого  access = 1 (ствим вручную в БД)
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 1) {
	exit();
}

ХОТИМ ЗАБЛОКИРОВАТЬ ПОЛЬЗОВАТЕЛЯ
// Чтобы можно было динамически блокировать пользователя
// Мы дожны каждый раз при обновлении страницы, делать запрос к БД и сверять какие там данные
// Создаем в папке modules файл allpages.php
// index.php подключаем его


//allpages.php
// Если человек авторизирован
if(isset($_SESSION['user'])) {
	// Обновляем данные с БД
	$res = q("
		SELECT *
		FROM `users`
		WHERE `id` = ".$_SESSION['user']['id']."
		LIMIT 1
	");
	$_SESSION['user'] = mysqli_fetch_assoc($res);
	// Проверем не забанин ли он
	if($_SESSION['user']['active'] != 1) {
		header("Location: index.php?module=cab&page=exit");
		exit();
	}
	
	
	
// Вот массив откуда берутся данные
Array -> $_SESSION
(
	[user] => Array -> ['user']
		(
			[id] => 15  -> ['id']
			[login] => inpost
			[password] => CBFO3Ao9BBt
			[email]
			[age]
			[active]
			[hash]
			[access]
		)
)


// например если человек авторизировался выводим форму, если нет, просим авторизироваться
if(isset($_SESSION['user'])) {
	// Выводим форму коментирования
} else {
	// Вам необходимо авторизироваться
}


домашка
Автоматическая авторизация
1. Данные храним в куки
ID = 10
HASH = FJL:KHJFGDXFGBHJN
HASH = ID + LOGIN + EMAIL
--> по этой связке авторизируем пользователя
если у пользователя такой ID и такой HASH то мы его автоавторизируем
2. HASH для автоавторизации будем хранить в БД

АВТОАВТОРИЗАЦИЯ КЛАССНАЯ ВЕЩЬ
НО НЕБЕЗОПАСНАЯ ДЛЯ ПОСЕТИТЕЛЕЙ

Ставить галочку или нет, запомнить логин и пароль, прописываем в auth.php
HASH = ID + LOGIN + EMAIL -> сохраним в $_COOKIE и в БД в поле hash

		
--> Справшиваем ставить галочку или нет при авторизации auth.php
сохраняем HASH на этой странице и в куках и БД

//allpages.php
// Создаем КУКИ только для тех кто поставил галочку
} else(isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'] )) {
	отсутствует:
	тех, кто не зарегестрировался на сайте
	кто вышел из сайта через кнопку выход
	кто не захотел поставить галочку, чтобы его автоматически авторизировали
	тех, кто захотел, чтобы его авторизировали, но не подошли IP или хеш или HTTP_USER_AGENT, по-этому была удалена кука
	$_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'] присутствует:
	только тех, кто захотел автоматически быть авторизированым и не вышел с сайта закрывая браузер через кнопку exit
	
// Проверять возможность на автоматическую авторизацию: myHash(ID+LOGIN+EMAIL)

// Автоматически авторизироваться (Она идет по желанию. Галочка говорит о том, что пользователь хочет автоматически быть авторизированным). Если галочки нет, не делаем авторизацию
// Кроме этого при автоавторизации проверьте все данные для авторизации, и если куки устарели (поменялся ip) - УДАЛИТЬ!
// Т.е. удалить в случае невозможной автоавтооризации
$_SESSION['user'] = mysqli_fetch_assoc($res);
// Но перед этим проверить:
1. Точно ли такой hash существует
2. Точно ли совпадаем одновременно и ID и hash в БД
3. Если вдруг такой hash не существует, то его необходимо удалить
4. в БД для СРАВНЕНИЯ хранить БОНУСОМ: ip, HTTP_USER_AGENT (браузер)
}

// Комментарии только для авторизированных пользователей
// Защитить модуль news от доступа тех пользователей, которые не имеют доступа к данному модулю, если 
if($_SESSION['user']['access'] != 5) {
		header("Location: index.php?module=cab&page=exit");
		exit();
}







































































