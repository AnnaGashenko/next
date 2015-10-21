<?php
function q($link, $query) {
	$res = mysqli_query($link, $query);
	if($res === false) {
		$info = debug_backtrace();
		wtf(info);
		echo "Запрос: ".$query.'<br>'.mysqli_error($link);
		// Отправку уведомления на почту
		// Логировать ошибки (записывать их в файл) file_put_contents('./log/mysql.log',strip_tags($query)."\n\n",FILE_APPEND);
		// file_put_contents() - записывает инфо в файл -> Создает файл по указанному пути './log/mysql.log'
		// FILE_APPEND - флаг. Еслм использовать функцию без этого параметра, то файл перезапишется. А так данные будут добавляться в конец файла
		// "\n\n" - означает, что каждая новая запись будет начинаться с новой строчки. Это важно!
		exit();
	}else{
		return $res;
	}
}

$res = q($link,"
	SELECT * 
	FROM `users`
	WHERE `id` = 1
	ORDER BY `id`
");
// var_dump - выводит полную характеристику переменной
var_dump($res);
echo '<hr>';



// Тогда можно ещё упростить фунцию поместив $link внутрь функции
function q($query) {
//  Достаем $link из глобального массива, чтобы она была видна внутри функции(все переменные дублируются $GLOBALS)
	$link = $GLOBALS['link'];
//  Либо так (тот же эффект)
//  global $link;
	$res = mysqli_query($link, $query);
	if($res === false) {
//		$info = debug_backtrace();
//		wtf(info);
		echo "Запрос: ".query.'<br>'.mysqli_error($link);
		// Отправку уведомления на почту
		// Логировать ошибки (записывать их в файл) file_put_contents('./log/mysql.log',strip_tags($query)."\n\n",FILE_APPEND);
		// file_put_contents() - записывает инфо в файл -> Создает файл по указанному пути './log/mysql.log'
		// FILE_APPEND - флаг. Еслм использовать функцию без этого параметра, то файл перезапишется. А так данные будут добавляться в конец файла
		// "\n\n" - означает, что каждая новая запись будет начинаться с новой строчки. Это важно!
		exit();
	}else{
		return $res;
	}
}

$res = q("
	SELECT * 
	FROM `users`
	WHERE `id` = 1
	ORDER BY `id`
");



// Теперь код значительно уменьшился
Было:
$res = mysqli_query($link,"ЗАПРОС") or exit(mysqli_error($link));
СТАЛО:
$res = q("ЗАПРОС");



//Добавляем функция в default.php

function q($query) {  //mysqli_query
//  Достаем $link из глобального массива, чтобы она была видна внутри функции(все переменные дублируются $GLOBALS)
//	$link = $GLOBALS['link'];
//  Либо так (тот же эффект)
    global $link;
	$res = mysqli_query($link, $query);
	if($res === false) {
//		$info = debug_backtrace();
//		wtf(info);
		$error = "QUERY: ".query."<br>\n".mysqli_error($link);
		// Отправку уведомления на почту
		// Логировать ошибки (записывать их в файл)
		file_put_contents('./log/mysql.log',strip_tags($query)."\n\n",FILE_APPEND);
		echo $error;
		// file_put_contents() - записывает инфо в файл -> Создает файл по указанному пути './log/mysql.log'
		// FILE_APPEND - флаг. Еслм использовать функцию без этого параметра, то файл перезапишется. А так данные будут добавляться в конец файла
		// "\n\n" - означает, что каждая новая запись будет начинаться с новой строчки. Это важно!
		exit();
	}else{
		return $res;
	}
}

// Создаем в корне папку logs -> создаем файл php с названием mysql.log и файл php.log
// Теперь ошибки которые будут возникать у нас или у других пользователей, автоматически будут попадать в mysql.log
// В файл ./logs/mysql.log -> помещаем содержимое пременной $query ("ЗАПРОС")

file_put_contents
Добавить в файл контент
1. Путь к файлу
2. Содержание
3. Дополнительные свойства, где FILE_APPEND - Дописывает инфо в файл, а не перезаписывает

$var = file_get_contents('./log/mysql.log');
Достает контент из файла
1. Путь к файлу
Возвращает - содержание файла

// Проверяем наличие файла и если есть делаем к нему запрос
if(isset(file_exists('./log/mysql.log')) {
	//делаем к нему запрос
}
file_exists();
Проверяет наличие файла
1. Путь к файлу
Возвращает TRUE / FALSE


// РАЗБИРАЕМ ФУНКЦИЮ TRIM()

$array = array(
	'  text ',
	' 1    ',
	'1 1',
	array(
		'x' =>'            1 1 ',
		'y' =>'               test          ',
		),
);

// Создаем функцию для обработки массива
function trimAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = trim($element);
	} else {
		// Делаем замыкание (рекурсию нашей функции -> идем вглубь массива и дастаем все вложенные массивы)
		$element = array_map('trimAll',$element)
	return $element;
}
$array = trimAll($array);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$array = array_map('trimAll',$array);

foreach($array as $k => $v) {
	$array[$k] = trim($v);
}

// ИЛИ
$array = array_map('trim',$array);
wtf($array);



// Создаем функцию для обработки массива, удаляем пустые пробелы
function mysqli_real_escape_stringAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = mysqli_real_escape_string(global $link,$element);
	} else {
		// Делаем замыкание (рекурсию нашей функции -> идем вглубь массива и дастаем все вложенные массивы)
		$element = array_map('mysqli_real_escape_stringAll',$element);
	return $element;
	}
}
$array = mysqli_real_escape_stringAll($array);
/////////////////////////////////////////////////////////////
		
		`login` = '".mysqli_real_escape_string($link,$_POST['login'])."',
		
		
if(isset($_POST['add'], $_POST['title'], $_POST['cat'], $_POST['text'], $_POST['description'], $_POST['cod'], $_POST['price'])){
	//Применяем функцию, чтобы убрать лишние проблелы в предложении - trim()	
	foreach($_POST as $k => $v){
		$_POST[$k] = trim($v);
	}

/$res = q("
	SELECT * 
	FROM `users`
	WHERE `id` = '1'1'
	ORDER BY `id`");

$array = array(
	"  Тек ' ст ",
	' 1ВАСЯ   ',
	"<br> <b>Ошибка найдена в файле:</b>",
	array(
		'x' =>"            1 ' 1,256 ",
		'y' =>'               test          ',
		),
);

foreach($array as $k => $v) {
	// Если $v массив
	if(is_array($v)) {
		// Делаем замыкание (рекурсию нашей функции -> идем вглубь массива и дастаем все вложенные массивы)
		foreach ($v as $k2=>$v2) {
			$array[$k][$k2] = trim($v2);
		} 
	} else {
		echo $k.'=>'.$v.'<br>';
		$array[$k] = trim($v);
	}
}

// Например у нас есть простая (не глубокая обработка массива)
foreach($array as $k => $v) {
	$array[$k] = trim($v);
}
// Можно сделать проще 
array_map('функция',$array(массив));
$array = array_map('trim',$array);

// Теперь с помощью array_map делаем глубокую обработку
function trimAll($element) {
	// Если элемент не массив, то обрабатываем trim (убираем пробелы)
	if(!is_array($element)) {
		$element = trim($element);	
	// Если элемент массив, то обрабатываем функцией array_map 
	// Делаем рекурсию, замыкание функции, наша функция будет залазить внутрь себя пока не обработает все вложенные массивы
	} else {
		$element = array_map('trimAll', $element);	
	}
	return $element;
}
// Обрабатываем функцией array_map нашу созданную функцию
//$array = array_map('trimAll',$array);
// Функция array_map уже есть внутри нашей функции, по-этому просто вызываем нашу
$array = trimAll($array);
wtf($array);

function stringAll($element) {
	global $link;
	// если $element не массив
	if(!is_array($element)) {
		$element = mysqli_real_escape_string($link,$element);
	} else {
		$element = array_map('stringAll', $element);	
	}
	return $element;
}




//htmlspecialchars
function htmlAll($element) {
	// Если элемент не массив, то обрабатываем htmlspecialchars
	if(!is_array($element)) {
		$element = htmlspecialchars($element);	
	// Если элемент массив, то обрабатываем функцией array_map 
	// Делаем рекурсию, замыкание функции, наша функция будет залазить внутрь себя пока не обработает все вложенные массивы
	} else {
		$element = array_map('htmlAll', $element);	
	}
	return $element;
}
// Обрабатываем функцией array_map нашу созданную функцию
//$array = array_map('trimAll',$array);
// Функция array_map уже есть внутри нашей функции, по-этому просто вызываем нашу
$array = htmlAll($array);
wtf($array);
	

// Создаем функцию для обработки массива, экранируем все символы ЧИСЛОВЫЕ
function intAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = (int)$element;
	} else {
		$element = array_map('intAll', $element);	
	}
	return $element;
}

$array =intAll($array);
wtf($array);


function floatAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = (float)$element;
	} else {
		$element = array_map('floatAll', $element);	
	}
	return $element;
}

$array =floatAll($array);
wtf($array);


//mb_stripos — Поиск позиции первого вхождения одной строки в другую, нечувствителен к регистру
$findme    = 'a';
$mystring1 = 'xyz';
$mystring2 = 'ABC';

$pos1 = mb_stripos($mystring1, $findme);
$pos2 = mb_stripos($mystring2, $findme);

// Конечно, 'a' не входит в 'xyz'
if ($pos1 === false) {
    echo "Строка '$findme' не найдена в строке '$mystring1'";
}

// Заметьте, что используется ===.  Использование == не даст верного 
// результата, так как 'a' в нулевой позиции.
if ($pos2 !== false) {
    echo "Нашел '$findme' в '$mystring2' в позиции $pos2";
}
//mb_strlen — Получает длину строки
$str = 'abcdef';
echo mb_strlen($str); // 6

//mb_strtolower — Приведение строки к нижнему регистру
$str = "У Мэри Был Маленький Ягненок и Она Его Очень ЛЮБИЛА";
$str = mb_strtolower($str);
echo $str; // Выведет у мэри был маленький ягненок и она его очень любила

//mb_strtoupper — Приведение строки к верхнему регистру
$str = "У Мэри Был Маленький Ягненок и Она Его Очень ЛЮБИЛА";
$str = mb_strtoupper($str);
echo $str; // Выведет У МЭРИ БЫЛ МАЛЕНЬКИЙ ЯГНЕНОК И ОНА ЕГО ОЧЕНЬ ЛЮБИЛА

//str_replace — Заменяет все вхождения строки поиска на строку замены
// присваивает: You should eat pizza, beer, and ice cream every day
$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");


//explode — Разбивает строку с помощью разделителя
//Часто возникает задача получения массива за счет разбиения строки по какому либо разделителю.
//В этом случае удобно воспользоваться функцией explode()

$str = "Имя Фамилия e-mail";
$arr = explode(" ", $str); // в нашем случае раделитем служит пробел
wtf($arr);
// Результатом работы скрипта будет:
Array
(
	[0] => Имя
	[1] => Фамилия
	[2] => e-mail
)

//implode — Объединяет элементы массива в строку
$array = array('имя', 'почта', 'телефон');
$comma_separated = implode(",", $array);
echo $comma_separated; // имя,почта,телефон

//strip_tags — Удаляет HTML и PHP-теги из строки
$text = '<p>Параграф.</p><!-- Комментарий --> <a href="#fragment">Еще текст</a>';
echo strip_tags($text);
echo "\n";

// Разрешаем <p> и <a>
echo strip_tags($text, '<p><a>');

Результат выполнения данного примера:
Параграф. Еще текст
<p>Параграф.</p> <a href="#fragment">Еще текст</a>


foreach($array as $k => $v) {
	
	$array[$k] = mysqli_real_escape_string($link, $v);
}

