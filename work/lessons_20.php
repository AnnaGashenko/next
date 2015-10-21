<?php


// Роутер (index.php)
//соединение
$link = mysqli_connect('DB_LOCAL,DB_LOGIN,DB_PASS,DB_NAME);

//кодировка
mysqli_set_charset($link, 'utf8');

//существуетдругой способ указания кодировки
// старый способ работает до PHP 5.2
mysqli_query("SET NAMES utf8");


//посылаем запрос на сервер
mysqli_query($link,"
INSERT INTO `users` SET
`login` = 'login1',
`age` = 20
");

//можно запрос записать в переменную
$query = "
INSERT INTO `users` SET
`login` = 'login1',
`age` = 20
";

mysqli_query($link,$query);


//можно вставлять переменные в сам запрос

$login = 'login2';
$age = 25;
$query = "
INSERT INTO `users` SET
`login` = '".$login."',
`age` = ".$age."
";


//ЭКРАНИРОВАНИЕ (экранируем обратным слешом - \ )
echo '<h1>Тек\'ст</h1>';
echo "<div style=\"text-decoration:underline\"></div>";

// Применяем функцию экранирования mysqli_real_escape_string
// Она применяется для строк. Экранируе все символы введенные пользователями
// Для числовых значений (int) 
// mysqli_real_escape_string и (int) -дает нам 100% защиту

$login = 'login2';
$age = 25;
$query = "
INSERT INTO `users` SET
`login` = '".mysqli_real_escape_string($link,$login)."',
`age` = ".(int)$age."
";

mysqli_real_escape_string


//XSS-inj инъекция - чтобы пользователь не смог ввести код html в поле логин и т.п.

htmlspecialchars — Преобразует специальные символы в HTML-сущности
 	Производятся следующие преобразования:
    '&' (амперсанд) преобразуется в '&amp;'
    '"' (двойная кавычка) преобразуется в '&quot;' в режиме ENT_NOQUOTES is not set.
    "'" (одиночная кавычка) преобразуется в '&#039;' только в режиме ENT_QUOTES.
    '<' (знак "меньше чем") преобразуется в '&lt;'
    '>' (знак "больше чем") преобразуется в '&gt;'

1. создаем модуль cub (кабинет)

registration.php

//Обработка регистрации
if(isset($_POST['login'],$_POST['password'],$_POST['email'],$_POST['age'])){
	// Создаем массив с ошибками
	$errors = array();
	if(empty($_POST['login'])){
		$errors['login'] = 'Вы не заполнили поле логин';
	}
	if(empty($_POST['password'])){
		$errors['password'] = 'Вы не заполнили поле пароль';
	}
	//Если поле не было заполнено (оно пустое) или не проходит проверку на валидацию e-mail
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Вы не заполнили поле e-mal';
	}
	//Если ошибок нет, то добавляем данные в БД
	if(!count($errors)){
		mysqli_query($link,"
		INSERT INTO `users` SET
		`login` = '".mysqli_real_escape_string($link,$_POST['login'])."',
		`password` = '".mysqli_real_escape_string($link,$_POST['password'])."',
		`email` = '".mysqli_real_escape_string($link,$_POST['email'])."',
		`age` = ".(int)$_POST['age']."'
		");
	//Записываем переменную в сессию, чтобы сохранить ее между страницами
	$_SESSION['regok'] = 'OK';
	// Делаем переадресацию на эту же страницу
	header("Location: /index.php?module=cab&page=registration");
	exit();

	}
}

registration.tpl

<div>
  <!--Если пользователь не зарегестрировался выводим форму-->
  <?php if(!isset($_SESSION['regok'])){ ?>
  <form action="" method="post">
    <table>
      <tr>
        <td>Логин *</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в 'value' и применем htmlspecialchars для защиты-->
        <td><input name="login" type="text" value="<?php echo @htmlspecialchars($_POST['login']); ?>"></td>
        <td><?php echo @$errors['login']; ?></td><!--<?php if(isset($errors['login'])){ echo $errors['login']; }?>-->
      </tr>
      <tr>
        <td>Пароль *</td>
        <td><input name="password" type="password" value="<?php echo @htmlspecialchars($_POST['password']); ?>"></td>
        <td><?php echo @$errors['password']; ?></td>
      </tr>
      <tr>
        <td>E-mail *</td>
        <td><input name="email" type="text" value="<?php echo @htmlspecialchars($_POST['email']); ?>"></td>
        <td><?php echo @$errors['email']; ?></td>
      </tr>
      <tr>
        <td>Возраст</td>
        <td><input name="age" type="text" value="<?php echo @htmlspecialchars($_POST['password']); ?>"></td>
        <td></td>
      </tr>
    </table>
    <p style="font-size:10px">* - обязательные для заполнения</p>
    <input name="sendreg" type="submit" value="Зарегистроваться">
  </form>
  <!--Удаляем сесию после переадресации-->
  <!--Иначе, если пользователь  зарегестрировался выводим сообщение и делаем переадресацию-->
  <?php } else {unset($_SESSION['regok']); ?>
  <div>Вы успешно зарегестриовались на сайте</div>
  <?php } ?>
</div>




ОБЗАТЕЛЬНО НУЖНО ПРОШЕЛ ЛИ ЗАПРОС К БАЗЕ ДАННЫХ (ДЛЯ ОТСЛЕЖИВАНИЯ ОШИБОК):
<?php

$res = mysqli_query($link, "SELECT * FROM `users`") or exit('Тут была ошибка:'.mysqli_error($link));
где mysqli_error($link) - функция которая выводит ошибки при запросе к БД

или можно вот так:

$res = mysqli_query($link, "SELECT * FROM `users`");
if($res === false){
	echo 'Произошла ошибка';
}