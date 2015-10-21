<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<script type="text/javascript" src="/skins/default/js/scripts_v1.js"></script>
</head>

<body>




1. Создаем в skins -> default -> js -> scripts_v1.js
Создавая скрипт в новом файле
- скрипт загружается всего 1 раз при первой загрузки страницы
- далее он подгружается из cash

2. В шапке прописываем путь к файлу со скриптом 
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<script type="text/javascript" src="/skins/default/js/scripts_v1.js"></script>
</head>


3. Если мы изменили скрипт у себя, он не будет изменен у пользователей,
т.к. браузер его уже загрузил в кеш и берет его оттуда
- для того чтобы изменения произошли меняем имя файла, на более новую версию (как бы)
было: scripts_v1.js
стало: scripts_v1-1.js

2-й способ обновить скрипт у пользователя, передать в пути get параметр
<script type="text/javascript" src="/skins/default/js/scripts_v1.js?2"></script>


Как создать связь php и js, если "php" работает с сервером, а "js" с браузером пользователя 

<?php
$x = 'Hello world';
?>
<script>
var x = '<?php echo $x; ?>';

В файле с раширением .js - php работать не будет
1. В .php или .tpl передаем значение в переменную скрипта
var x = '<?php echo $x; ?>';
и там уже будет просто значение
var x = 'Hello world';
и далее можно свободно обращаться к ней в файле .js 
</script>


<?php



//Если нам нужно подключить скрипт js в модуле 
Core::$JS[] = '<script type="text/javascript" src="/skins/default/js/scripts_v1.js?2"></script>';
// т.к. $JS - это массив передаем его как массив

//Создадим класс ЯДРО
class Core {
	static $CREATED  = 2013;
	static $CONT     = 'modules';
	static $SKIN     = 'default';	
	static $DB_NAME  = 'main';	
	static $DB_LOGIN = 'test';	
	static $DB_PASS  = 'test';	
	static $DB_LOCAL = 'localhost';	
	static $DOMAIN   = 'http://next/';
	static $UPLOADER_DIR = '/uploaded/';	
	static $JS   = array();
	static $CSS  = array();
	static $META = array(
		'title'=>'стандартный TITLE',
		'description'=>'d',
		'keywords'=>'k'
	);

}
?>


Если нам нужно отладить скрипт на боевом сервере
мы не можем воспользоваться alert(); т.к. это увидять пользователи
для этого есть функция console.log 

<script>

var x = 1;
var y = 2;
var z = x + y;

console.log(z); // выведит нам в консоль чему равно z


_____________________________________________________________________________

                                 setInterval

x = 0;								 
function test() {
	++x;
	console.log('Hello'); 
	// когда х = 5
	if(x == 5) {
		clearInterval(intervalId); // останавливаем интервал
	}
}

var intervalId = setInterval(test,2000) // код выполняется раз в 2 секунды
// 1000 милисекунд = 1 секунда

// чтобы вызвать несколько функции или передать в ф-ю аргументы
// нужно создать безимянную ф-ю function()

var intervalId = setInterval(function() {
	test('arg1','arg2');
	test('arg1','arg2');
	hideShow('Hello');
},2000)

-----------------------------------------------------------------------------------

                                       setTimeout
						        ЗАДЕРЖКА ВЫПОЛНЕНИЯ КОДА


var intervalId = setTimeout(test,2000) // код выполняется один раз через 2 секунды

</script>
</body>
</html>
