<?php
	error_reporting(-1);  
    header("Content-Type: text/html; charset=utf-8");
?>

<html>
<head>
</head>

<body>

<?php

	if(!isset($_GET['page']))
{
	$_GET['page'] = 'main';
}

?>
			
	Навигация:
	<a href="15.php?page=main">Главная</a>
	<a href="15.php?page=contacts">Контакты</a>
	<a href="15.php?page=aboutus">О себе</a>
	
	<?php include $_GET['page'].'.php';?>


<?php

/*is_array — Определяет, является ли переменная массивом*/

$yes = array('это', 'массив');

echo is_array($yes) ? 'Массив' : 'Не массив';
echo "\n";

$no = 'это строка';

echo is_array($no) ? 'Массив' : 'Не массив';

/*is_bool — Проверяет, является ли переменная булевой*/
$a = false;
$b = 0;

// Так как $a является булевой переменной, функция вернет true
if (is_bool($a) === true) {
    echo "Да, это булевая переменная";
}

// Так как $b не является булевой переменной, функция вернет false
if (is_bool($b) === false) {
    echo "Нет, это не булевая переменная";
}



/*is_numeric — Проверяет, является ли переменная числом или строкой, содержащей число*/
$var = 'Hello';
if(is_numeric($var)){
	echo 'Переменная var - это число';
}

//is_float — Проверяет, является ли переменная числом с плавающей точкой


if (is_float(27.25)) {
    echo "is float\n";
} else {
    echo "is not float\n";
}
var_dump(is_float('abc'));
var_dump(is_float(23));
var_dump(is_float(23.5));
var_dump(is_float(1e7));  //Научная форма записи
var_dump(is_float(true));

//is_int — Проверяет, является ли переменная переменной целочисленного типа

if (is_int(23)) {
    echo "целое\n";
} else {
    echo "не целое\n";
}
var_dump(is_int(23));
var_dump(is_int("23"));
var_dump(is_int(23.5));
var_dump(is_int(true));

//is_null — Проверяет, является ли значение переменной равным NULL

error_reporting(E_ALL);

$foo = NULL;
var_dump(is_null($inexistent), is_null($foo));


//is_numeric — Проверяет, является ли переменная числом или строкой, содержащей число

$tests = array(
    "42", 
    1337, 
    "1e4", 
    "not numeric", 
    array(), 
    9.1
);

foreach ($tests as $element) {
    if (is_numeric($element)) {
        echo "'{$element}' - число", PHP_EOL;
    } else {
        echo "'{$element}' - НЕ число", PHP_EOL;
    }
}

//is_string — Проверяет, является ли переменная строкой

if (is_string("23")) {
    echo "строка\n";
} else {
    echo "не строка\n";
}
var_dump(is_string('abc'));
var_dump(is_string("23"));
var_dump(is_string(23.5));
var_dump(is_string(true));

/*Результат выполнения данного примера:
строка
bool(true)
bool(true)
bool(false)
bool(false)
*/

?>

</body>
</html>

