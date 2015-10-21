<?php
1. Например у нас есть кисть в фотошопе с определянными функциями и параметрами.

КЛАССЫ - это объединение функций и переменных в одной области видимости!!!

// Классы это набор свойств и методов для реализации поставленной задачи
// Первая область видимости (class - это оболочка, в которую мы можем помещать множество функций, переменных и т.п.)

class brush {
	// Переменные внутри класса = это свойства
	static $opacity = 100; // Прозрачность кисти
	static $size = 30; // Размер кисти
	// Функции = называются методы
	static function makeLine1() {
	}
	static function makeLine2() {
	}	
	static function makeLine3() {
	}	
}

// Ссылаемся на переменные ---- через "имя класса"
// Мы можем через класс обатиться к определенной переменной или к функции
// Говорим: хотим вывести переменную $opacity из класса "brash"
echo brush::$opacity;
echo brush::makeLine1(5,456);
exit();

Если у кисти и у карандаша есть переменная $size - они не пересекаются, т.к.
находятся внутри своего класса и видны только там!

// Карандаш
class pencil {
	// Переменные внутри класса = это свойства
	// Переменные внутри класса видны только для этого класса
	// Прозрачность карандаша
	static $opacity = 80;
	// Размер карандаша
	static $size = 50;
	// Функции = называются методы
	static function makeLine1() {
		// рисовать первой кистью
		echo 'TEST_FUNCTION';
	}
	static function makeLine2() {
		// рисовать второй кистью
	}	
	static function makeLine3() {
		// рисовать третьей кистью
	}	
}
echo pencil::$opacity.'<br>';
echo pencil::makeLine1(5,456);
exit();




// Например нам нужно сделать пагинатор
class paginator {
	// показать 9 страниц
	static $howpages = 9;
	// показывать ли страницы в виде чисел
	static $shownumber = true;
	// показывать кнопку nextpage
	static $showtext = true;
	
	static function showPaginator() {
		// получает переменную из вне, перезаписывает ее
		// Это в том случае, если мы переменную перезаписываем paginator::$howpages = 5;
		// ссылается сам на себя -> получает переменную и записывает ее в $howpages
		$howpages = paginator::$howpages;
		// self - ссылаемся к определенному свойсву данного класса
		// т.е. переменная $howpages - будет браться, та которая записана внутри класса, а не из вне
		self::$howpages;
		if (self::$howpages == 5) {
			echo 'Что-то своё';
		}
		echo '1,2,3,4';
		// или return '1,2,3,4';
	}
}

// Вызываем ф-ю showPaginator которая выведит нам '1,2,3,4'
// так выводим в view если в ф-и "echo '1,2,3,4';"
paginator::showPaginator();
// так выводим в controller если в ф-и если "return '1,2,3,4' "
$pages = paginator::showPaginator();

НАМ НУЖНО ВЫВЕСТИ ПАГИНАТОР НА ДРУГОЙ СТРАНИЦЕ
- и заказчик говорит: я не хочу выводить 9 страниц, а хочу
* в новостях - 9
* на блоге - 5
* на форуме - 7

// перезаписываем переменную
echo '<hr>';
paginator::$howpages = 5;
paginator::showPaginator();
exit();

ЗАКАЗЧИК ХОЧЕТ, ЧТОБ КНОПКА showtext не показывалась
-----------------------------------------------------
paginator::$showtext = false;
paginator::showPaginator();
exit();


СТАТИЧНЫЕ static (Глобальная область видимости)
1. Мы можем к ним ссыллаться из любой точки нашего кода
2. Видны из других функций и классов 
3. Они такие как $_POST, $_GET $_SESSION


* Переменные внутри класса = это свойства
* Функции внутри класса = методы 


КЛАСС - это набор свойств и методов, для реализации поставленной задачи!!!

// Например если в модуле новости мы хотим выводить не по 9 страниц, а 5, то  просто перезаписываем переменную
paginator::$howpages = 5;
$pages = paginator::showPaginator();

//Вдруг на какой то странице нам нужно чтоб кнопки "Следущая страница" и "Предыдущая" не выводились
paginator::$showtext = false;
$pages = paginator::showPaginator();
_______________________________________________________
class paginator {
	static $howpages = 9;
	static $shownumber = true;
	static $showtext = true;
	
	static function showPaginator() {
		// проверяем $howpages == 5 (не равно т.к. $howpages = 9)
		if (self::$howpages == 5) {
			echo 'Что-то своё';
		}
		echo '1,2,3,4';
		// или return '1,2,3,4';
	}
}

// Выведит 1,2,3,4
paginator::showPaginator();
echo '<hr>';


paginator::$howpages = 5; // Выведит Что-то своё
paginator::showPaginator(); // Выведит 1,2,3,4

I. Открываем config.php -> переделываем под классы
// Так становится понятнее, что мы работаем с ядром
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
// Если нужно вывести нашу переменную echo Core::$SKIN;
* index.php
$link = mysqli_connect(Core::$DB_LOCAL,Core::$DB_LOGIN,Core::$DB_PASS,Core::$DB_NAME);

II. Например, нам нужно на оной странице обращаться к пескольким пагинаторам
и чтобы переменные не стирали одна другую
- рисуем на одной странице круг и квадрат

$var1 = illustrator;
$var2 = illustrator;

$var1 = 'шар';
$var1['радиус'] = '10';
$var2 = 'квадрат';

КАК ССЫЛАТЬСЯ НА ПЕРЕМЕННЫЕ:
// СТАТИКА self::$var; - static
// ЭКЗЕМПЛЯР $this->$var - public


// есть 3 параметра переменной - public, private, protected;
class Illustrator{
	public $radius = 10; // public, private, protected
	private $type = 'XML';

    // Для того, чтобы можно было обратиться к функции вне класса, нужно создать ф-ю с public
	public function makeGraphic() {
		// ссылаемся на ф-ю test()
		$this->test;
		echo $this->radius;
	}
	// Если private - мы не можем обращаться к функции вне класса
	private function test() {
		
	}
}

// создаем экземпляр класса - это значит пишем впереди "new"
$ill_1 = new Illustrator; // object
$ill_2 = new Illustrator;
// выводим его
// При static мы бы вывели 
echo Illustrator::$radius;
// При экземпляре
echo $ill_1->radius;
echo '<hr>';
echo $ill_2->radius;

// Можем поменять значение радиуса
// Экземпляр создается для того, чтобы можно было начертить 2 круга с разным радиусом
$ill_1->radius = 5;
$ill_1->radius = 33;

-----------------------------------------------------
При private мы не можем таким образом менять и выводить значения

class Illustrator{
	private $radius = 10; 

	public function makeGraphic() {
		// ссылаемся на ф-ю test()
		$this->test;
		echo $this->radius;
	}
	// Внутри самого класса переменная private $radius = 10 видна
	private function changeRadius($radius) {
		$this->radius = $radius;
	}
}
// Снаружи нет -> выдаст ошибку
$ill_1->radius = 5;

// Но можно к ней обратиться через ф-ю в которой она записанна, ведь в ф-и она видна
$ill_1 = changeRadius(5);
$ill_2 = changeRadius(33);

$ill_1->makeGraphic();
echo '<hr>';
$ill_2->makeGraphic();

// Если переменная не используется внутри ф-и, то мы никогда не сможем ее перезаписать

class Illustrator{
	public $radius = 10; 
	private $type = 'XML';
	
	public function makeGraphic() {
		// ссылаемся на ф-ю test()
		$this->test;
		echo $this->radius;
	}
	
	private function test() {

	}
}

$test = new Illustrator;
// Добавляем переменную lala
$test->lala = 'Эксперимент';
echo '<pre>'.print_r($test,1).'</pre>';

Illustrator Object
(
    [radius] => 10
    [type:Illustrator:private] => XML
    [lala] => Эксперимент
)


//Рассмотрим какие переменные существуют
$var = 10; // int
$var = 10,2; // float
$var = 'text'; // string
$var = false; // bool boolean


//Например
$var = holodilnik::ohladit('Рыбу');
echo $var; // Охлажденная рыба
___________________________________________________________________________

class Name {
	// public - это тоже что и var в php4 - мы объявляем интрпритатору php что это свойства класса
	public $name;
	
	function GetName($name) {
		// $this-> псевдопеременная
		// $this-> текущий (т.е. что-то в текущем классе)
		// name - пищеться без знака $
		// мы говорим: взять свойства из текущего класса
		$this->name = $name;
		return $this->name;
	}
}

// Теперь нам нужно создать объект
$name = new Name;
// как через $this-> мы можем обратиться к любому свойству или методу в классе
// так и через $name = new Name; мы можем обратиться к любому свойству или методу в классе
echo $name->GetName("Анна");

___________________________________________________________________________

                                                   КОНСТРУКТОР

class Users {
	public $variable;
	
	function __construct() {
		$this->variable = "Hello world";
	}
	function show() {
		return $this->variable;
	}
}

// PHP проходит класс, доходит до объекта - видит объект - значит к классу можно обратиться
// Затем ищет метод который называется __construct()
// Если он его находит, он выполняет все, что в нем находится
$user = new Users;
// Далее идет дальше и выполняет метод show()
echo $user->show(); // Hello world

___________________________________________________________________________

                        СПЕЦИФИКАТОРЫ
						
class L {
	public $variable = 1;
	public $copy = "&copy; 2015";
	
	public function getSong() {
		return $this->variable.$this->copy;
	}
}

$l = new L;
// Пользователь не захочит выводит наш копирайт и выведит только $variable = 1;
// И может присвоить свой скрипт себе
echo $l->variable; // 1


class L {
	private $variable = 1;
	private $copy = "&copy; 2015";
	
	public function getSong() {
		return $this->variable.$this->copy;
	}
}

$l = new L;
echo $l->variable; // будет ошибка т.е. у $variable -> private(не доступная)

// но у ф-и function getSong() -> public(видимая)
// так мы можем вывести наши copyright
echo $l->getSong(); // 1&copy; 2015

_________________________________________________________________________________

                                          НАСЛЕДОВАНИЕ КЛАССОВ
										  
Наследование - это механизм, посредствам которого один или несколько классов
можно получить с помощью некоторого базового класса!										 

ГЛАВНЫЙ КЛАСС - родительский
ТЕ КОТОРЫЕ НАСЛЕДУЮТ - дочерние

// Родительский класс
class SuperUser{
	protected $prava;
	protected $userName;
}

// Дочерний класс
// Прописываем наследование "extends"
// Наследовать класс можно только один
class Admin extends SuperUser {
	
}

_____________________________________________________________________________________

                                                 ДЕСТРУКТОР
class Auto{
	private $name;
	private $id;
	
	function __construct($name) {
		$this->name = $name;
	}
	function getID($id) {
		$this->id   = $id;
	}
	
	// деструктор не принимает никаких значений
	function __destruct() {
		echo "Работает деструктор";	
	}
}

// создаем объект
// // конструктор запускается когда мы создаем объект
$auto = new Auto;
echo $auto->getID(4);
// деструктор запускается когда мы удаляем объект
unset($auto); // Выыедит: Работает деструктор

__________________________________________________________________

                                 СТАТИЧЕСКИЕ СВОЙСТВА И МЕТОДЫ

class Test{
	// Обозначение
	static public $property;
	
	public function getTest(){
		// Вызов
		return self::$property;	
	}
}

// Вызов вне класса
$test = Test::$property;

----------------------------------
class MyTest{
	public $property;
	
	function getResult(){
		return $this->property;	
	}
}

echo MyTest::getResult(); // в таком случаем выдаст ошибку, т.к. объект еще не создан

_____________________________________________________________________________________

// Чтобы код работал
class MyTest{
	// присваиваем свойству static
	static public $property;
	
	// методу можно присваивать static, а можно и нет
	// т.к. мы его не вызываем через $this-> (через)
	// вызываем его из вне через class "echo MyTest::getResult();"
	function getResult(){
		// передаем внутри метода значение 5 для объекта $property
		self::$property = 5;
		return self::$property;	
	}
}

echo MyTest::getResult(); // выдаст 5
echo '<br>';
echo MyTest::$property; // будет пусто, т.к. мы задали значение переменной только внутри метода
_______________________________________________________________________________________________

                                           КОНСТАНТЫ КЛАССА
										   
Константы ещё называют постоянными свойствами
константы записывают заглавными буквами
									   									  
class Test{
	const COUNT_CH = 5;
	// Вызов
	self::COUNT_CH;
}
// Вызов из вне класса
Test::COUNT_CH;



class MyClass{
	const AVR = 1;
	const BVR = 5;
	
	function result() {
		return self::AVR;
	}
}
echo MyClass::result(); // выведит 1
echo MyClass::BVR; // 5
















