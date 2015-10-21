<?php
/*
ALIAS:
q(); Запрос
es(); mysqli_real_escape_string

РАБОТА С ОБЪЕКТОМ ВЫБОРКИ
$res = q(); // Запрос с возвратом результата
$res->num_rows; // Количество возвращенных строк - mysqli_num_rows();
$res->fetch_assoc(); // достаём запись - mysqli_fetch_assoc();
$res->close(); // Очищаем результат выборки

РАБОТА С ПОДКЛЮЧЕННОЙ MYSQL
DB::_()->affected_rows; // Количество изменённых записей
DB::_()->insert_id; // Последний ID вставки
DB::_()->real_escape_string(); // аналог es();
DB::_()->query(); // аналог q
DB::_()->multi_ query(); // Множественные запросы

DB::close(); // Закрываем соединение с БД
*/

class DB {
	static public $mysqli = array();
	static public $connect = array();
	
	static public function _($key = 0) {
		if(!isset(self::$mysqli[$key])) {
			if(!isset(self::$connect['server']))
				self::$connect['server'] = Core::$DB_LOCAL;
			if(!isset(self::$connect['user']))
				self::$connect['user'] = Core::$DB_LOGIN;
			if(!isset(self::$connect['pass']))
				self::$connect['pass'] = Core::$DB_PASS;
			if(!isset(self::$connect['db']))
				self::$connect['db'] = Core::$DB_NAME;

			self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']); // WARNING
			if (mysqli_connect_errno()) {
				echo 'Не удалось подключиться к Базе Данных';
				exit;
			}
			if(!self::$mysqli[$key]->set_charset("utf8")) {
				echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
				exit;
			}
		}
		return self::$mysqli[$key];
	}
	static public function close($key = 0) {
		self::$mysqli[$key]->close();
		unset(self::$mysqli[$key]);
	}
}

function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

// Функция вывода ошибок
function q($query,$key = 0) {
	// DB::_()->query("запрос");
	$res = DB::_($key)->query($query);
	if($res === false) {
		$info = debug_backtrace();
		// mysqli::$error -- mysqli_error — Возвращает строку с описанием последней ошибки
		$error = "QUERY: ".$query."<br>\n".DB::_($key)->error."<br>\n".
		         "file: ".$info[0]['file']."<br>\n".
				 "line: ".$info[0]['line']."<br>\n".
				 "date: ".$info[0]['date']."<br>\n".
				 "================================";
				 
		file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
		echo $error;
		exit();
	}
		return $res;
}


// Создаем функцию для обработки массива, удаляем пустые пробелы
function trimAll($element) {
	// Если элемент не массив, то обрабатываем trim (убираем пробелы)
	if(!is_array($element)) {
		$element = trim($element);	
	} else {
		// Делаем замыкание (рекурсию нашей функции -> идем вглубь массива и дастаем все вложенные массивы)
		$element = array_map('trimAll', $element);	
	}
	return $element;
}


// Создаем функцию для обработки массива, экранируем все символы
function stringAll($element, $key = 0) {
	global $link;
	// если $element не массив
	if(!is_array($element)) {
		$element = DB::_($key)->real_escape_string($element);
	} else {
		$element = array_map('stringAll', $element);	
	}
	return $element;
}
	
	
// 	htmlspecialchars
function htmlAll($element) {
	if(!is_array($element)) {
		$element = htmlspecialchars($element);	
	} else {
		$element = array_map('htmlAll', $element);	
	}
	return $element;
}

// int
function intAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = (int)$element;
	} else {
		$element = array_map('intAll', $element);	
	}
	return $element;
}

//float
function floatAll($element) {
	// если $element не массив
	if(!is_array($element)) {
		$element = (float)$element;
	} else {
		$element = array_map('floatAll', $element);	
	}
	return $element;
}

//autoload
function __autoload($class) {
	include './libs/class_'.$class.'.php';
}

// Хэширование данных
function myHash ($var) {
 // Соль нужна, чтобы запутать того кто захочет раскодировать хэш 
	$salt_1 = 'ABC'; 
	$salt_2 = 'CBA'; 
// Прогоняем через ХЭШ с солью
	$var = crypt(md5($var.$salt_1),$salt_2);
	return $var;
}

function paginator($page, $total)   
{  
	$menu = ' | ';  
	for($i = 1; $i <= $total; ++$i)   
		if($page == $i)  
			$menu .= '<strong>'. $i  .'</strong> | ';  
		else  
			$menu .= '<a href="/reviews/main?page='. $i .'">'. $i .'</a> | ';       

	return $menu;   
}

function pagination ($page, $total, $show_pages = 5) {

}