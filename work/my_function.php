<?php


//Функция - программный блок, который может выполняться в любом месте сценария

// Описание функции
function sayHello() {
	echo "Hello, world!";
}
// Вызов функции
sayHello();
sayHello();
sayHello();


// Проверка, существует ли такая функция уже или нет
if(function_exists("sayHello")) {}
// если ф-я уже существует - true
// если ф-я не существует - false

// В ф-ю можно передавать параметры
function sayHello($name) {
	echo 'Hello, '.$name;
}
sayHello('John');
$n = 'Mike';
sayHello($n);
sayHello();



// Передаем также второй параметр
function sayHello($name, $h) {
	// echo '<h1>Hello, '.$name.'</h1>';
	echo '<h'.$h.'>Hello, '.$name.'</h'.$h.'>';
}
sayHello('John',1);
$n = 'Mike';
sayHello($n,2);
// записываем ф-ю в переменную
$str = 'sayHello';
// Когда php встречаеит $str( - переменную с круглой скобкой, то он понимает
// что от него требуется вызов ф-и имя которой лежит в этой переменной $str
$str('Guest',3);


function sayHello($name) {
	// echo '<h1>Hello, '.$name.'</h1>';
	echo 'Hello, '.$name;
}
// Вызываем функцию, варивнт 1
	sayHello('Иван');

// Вызываем функцию, варивнт 2
	$name = 'Петр';
	sayHello($name);

// Вызываем функцию, варивнт 3
	$func = 'sayHello';	
	$func("Игорь");
	
________________________________________________________________________________________________________

                                    //Глобальные и локальные переменные

// Все переменные находящиеся внутри функции видны только внутри функции
function sayHello($name) {
	echo '<h1>Hello, '.$name.'</h1>';
	// чтобы переменная была видна и вне ф-и, нужно обявить ее глобальной
	global $name;
	$name = 'Vasya';
}
sayHello('John');
$name = 'Mike';
sayHello($name);
echo $name; // Mike


// Но у global есть недостатки:
// 1. Он перезаписывает(удвляет) переменную $name = 'Mike';


// У PHP есть свой глобальный массив
// Когда мы записываем вот так:
$age = 25;
// PHP создает массив 
$GLOBALS['age'] = 25;

function sayHello($name) {
	echo '<h1>Hello, '.$name.'</h1>';
	// чтобы переменная была видна и вне ф-и, нужно обявить ее глобальной
	// global $name;
	// мы можем также записать вот так:
	$GLOBALS['name'] = 'Vasya'; //  это как $name = 'Vasya';
}
sayHello('John');
$name = 'Mike';
sayHello($name);
echo $name; // Mike
---------------------------------------------------------------------------------

$a = 1; // глобальная область видимости
function test() {
	echo $a; // локальная область видимости
}
test(); // Не выведет ничего, т.к. внутри функции не видна $a = 1;
------------------------

$a = 1; $b = 2;
function sum() {
	global $a, $b;
	$b = $a + $b;
}
sum();
echo $b; // Выведет 3

// Другой вариант
function sum() {
	$GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
}
---------------------------------------------------------------

// Зашел в функцию - произвел действия - вышел и все удалил
function test() {
	$a = 0;
	echo $a++;
}
test(); // Выведет 0
test(); // Выведет 0
test(); // Выведет 0


// Однако, может возникнуть потребность, чтоб запомнить предыдущие действия

function test() {
	static $a = 0; // ф-я не умрет
	echo $a++;
}
test(); // Выведет 0
test(); // Выведет 1 - пропускает строку static $a = 0; и выводит echo $a++;
test(); // Выведет 2


// Программирование гласит: не создавайте лишних переменных

function getSum($n1, $n2) {
	$res = $n1 + $n2;
	// мы не хотим выводим результат, а хотим просто получить его
	return $res;
}

// Вывод результат
// php видит переменную - видит что она присваивает ф-ю
// выполняет код ф-я и то, что ф-я возвращает то и присваивает $result
$result = getSum(2,3);
echo $result;

// Второй вариант
function getSum($n1, $n2) {
	// return не только возвращает, но и заканчивает код
	return $n1 + $n2; 
	// если после return будет идти код, то php его не прочтет уже
}
echo getSum(2,3);


______________________________________________________________________

ФУНКЦИЯ ОТРИСОВКИ МЕНЮ

$v_menu = array(
			"Home"    =>'index.php',
			"About"   =>'about.php',
			"Contact" =>'contact.php',
			"Search"  =>'search.php'
			);
$h_menu = array(
			"Girl"    =>'index.php',
			"Boys"   =>'about.php',
			"Newborn" =>'contact.php',
			"Everybody"  =>'search.php'
			);
// по умолчание меню - вертикальное
function getMenu($menu,$vertical=true){
	echo '<ul style="list-style-type:none">';
	foreach($menu as $link => $href) {
		echo '<li><a href='.$href.'>'.$link.'</a></li>';
	}
	echo '</ul>';
}

// Выводим меню
getMenu($v_menu);
------------------------------------------------------------------------
function getMenu($menu,$vertical=true){
	// стиль меню
	$style = '';
	if(!$vertical){
		$style = ' style="display:inline;margin-right:15px;"';
	}
	echo '<ul style="list-style-type:none">';
	foreach($menu as $link => $href) {
		echo '<li'.$style.'><a href='.$href.'>'.$link.'</a></li>';
	}
	echo '</ul>';
}
// Горизонтальное меню
getMenu($h_menu,false);

-----------------------------------------------------------------------

// Описать своими силами встроенную функцию COUNT
	// какие типы данных можно передать в эту ф-ю?
	// любой тип данных
	
	// что делает функция?
	// если массив Array => возвращает "кол-во ячеек"
	// NULL => 0
	// Все остальное => 1

function myCount($item) {
	// нужно определиться с типом данных которые приходят
	// есть специальные ф-и для определения типа данных
	// NULL => 0
	if(is_null($item)) {
		return 0;
	}
	// Идем от обратного, если это не массив
	// Все остальное => 1
	if(!is_array($item)) {
		return 1;
	} 
	// Если массив пустой - вернется 0
	$cnt = 0;
	foreach($item as $v) {
		$cnt++;
	}
	return $cnt;
}

$array = array(
			"Home"    =>'index.php',
			"About"   =>'about.php',
			"Contact" =>'contact.php',
			"Search"  =>'search.php'
			);


echo myCount(12); // Вернет 1
echo '<br>';
echo myCount(NULL); // Вернет 0
echo '<br>';
echo myCount($array); // Вернет 4


// Но если будет многомерные массив то эта ф-я не посчитает их
// Добавляем еще один параметр $mode=0
// А если передать $mode=1 - будет считать многомерные массивы
// Нам поможет рекурсия
function myCount($item, $mode=0) {
	if(is_null($item)) {
		return 0;
	}
	if(!is_array($item)) {
		return 1;
	} 
	$cnt = 0;
	foreach($item as $v) {
		// Проверяем есть ли внутри еще массив
		if($mode == 1 && is_array($v)) {
			$cnt += myCount($v, 1);
		}
		$cnt++;
	}
	return $cnt;
}


РЕКУРСИВНЫЙ ВЫЗОВ ФУНКЦИИ
Рекурсивная ф-я - это ф-я которая вызывает сама себя

function factorial($n) {
	if($n == 0) return 1;
	return $n * factorial($n-1);
}

$result = factorial(5);
echo "5! = " .$result;


// Можно и не принимать агрументы ф-и в скобках
function foo() {
// вернет число переданных документов
	echo func_num_args(); // вернет 3
	// получаем аргументы
	// с помощью ф-и func_get_args - получаем массив
	$args = func_get_args();
	print_r($args);  // Array ( [0] => a [1] => 25 [2] => 1 )
	// можно напрямую обратиться к аргументу
	// в скобках пишем порядковый номер аргумента (начало от 0)
	echo func_get_arg(1); // вернет 25
}
foo('a',25,true)


$a = 10;
$b = $a; // это копия $a
// в $b лежит адресс на перемнную $a
$b = &$a; // это ссылка на $a (как ярлык на рабочем столе)





















function resize() {
	$types = array('image/gif','image/jpeg','image/png');
	$array2 = array('jpg','jpeg','png');
	$path = '/uploaded/original/';
	$tmp_path = '/uploaded/avatar/100x100/';
	if(isset($_POST['submit'])){
		if($_FILES['file']['error'] == 0){
			if ($_FILES['file']['size'] < 5000 || $_FILES['file']['size'] > 5000000){
				echo 'Размер изображения нам не подходит';
			} else {
				preg_match('#\.([a-z]+)$#iu',$_FILES['file']['name'],$matches);
				if(isset($matches[1])) {
					// Если пользователь загрузит файл с расширение в верхнем регистре JPEG
					// Делаем его в нижнем регистре с помощью mb_strtolower
					$matches[1] = mb_strtolower($matches[1]);
					
					// getimagesize - получаем инфо о файле				
					$size = getimagesize($_FILES['file']['tmp_name']);
					$name = date('Ymd-His').'img'.rand(10000,99999).'.'.$matches[1];
					
					if(!in_array($matches[1],$array2)){ // проверяем совпадения массивов
						echo 'Не подходит расширение изображения';	
					// in_array - возвращает true, если элемент со значением $temp['mime'] присутствует в массиве $array;
					} elseif(!in_array($size['mime'],$types)){
						echo 'Не подходит тип файла, можно загружать только изображения';	
					} elseif(!move_uploaded_file($_FILES['file']['tmp_name'], '.'.$path .$name)){
						echo 'Изображение не загружено! Ошибка';
					} else {
						echo 'Наше изображение загруженно верно';
						
						//Создаём новое изображение из «старого»
						if ($size['mime'] == 'image/jpeg') {
							$src = imagecreatefromjpeg('.'.$path .$name);
						} elseif ($size['mime'] == 'image/png') {
							$src = imagecreatefrompng('.'.$path .$name);
						} elseif ($size['mime'] == 'image/gif') {
							$src = imagecreatefromgif('.'.$path .$name);
						}
		
						//Берём числовое значение ширины фотографии, которое мы получили в первой строке и записываем это число в переменную
						$iw=$size[0];
						//Проделываем ту же операцию, что и в предыдущей строке, но только уже с высотой.
						$ih=$size[1];
						// Проверяем если ширина или высота больше 100
						if ($iw > 100 || $ih > 100){
							// если ширина больше высоты 
							if($iw >= $ih) {
								//Ширину фотографии делим на 100 т.к. на выходе мы хотим получить фото шириной в 100 пикселей. В результате получаем коэфициент соотношения ширины оригинала с будущей превьюшкой.
								$new_w=100;
								$koe = $iw/$new_w;
								//Делим высоту изображения на коэфициент, полученный в предыдущей строке, и округляем число до целого в большую сторону — в результате получаем высоту нового изображения.
								$new_h=ceil ($ih/$koe);
							// если высота больше ширины
							} elseif($size[0] < $size[1]) {
								$new_h=100;
								$koe=$ih/$new_h;
								$new_w=ceil ($iw/$koe);
							}
						
							//Создаём пустое изображение шириной и высотой, которую мы вычислили в предыдущей строке.
							$dst=imagecreatetruecolor($new_w, $new_h);
							//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
							imagecopyresampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);
							
							//Сохраняем полученное изображение в формате
							if ($size['mime'] == 'image/jpeg') {
								imagejpeg($dst, '.'.$tmp_path .'small_'.$name, 100);
							} elseif ($size['mime'] == 'image/png') {
								imagepng($dst, '.'.$tmp_path .'small_'.$name, 100);
							} elseif ($size['mime'] == 'image/gif') {
								imagegif($dst, '.'.$tmp_path .'small_'.$name, 100);
							}
							
							// Освобождаем память
							imagedestroy($src);
						}
						// Сохраняем путь к фото в БД 
						q("
							UPDATE `users` SET
							`img`        = '".stringAll($tmp_path .'small_'.$name)."'
							WHERE `id`   = ".(int)$_SESSION['user']['id']."
						"); 
						
					}
				} else {
					echo 'Данный файл не является картинкой';	
				}
			}
		}
	}
}

// Вызываем ф-ю
resize();
