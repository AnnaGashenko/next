<?php


//Mail::testSend();

/*
class myName1 {
	static $opacity = 100;
	static $size = 30;
	
	static function makeLine1() {
		echo 'TEST_FUNCTION';
	}
	static function makeLine2() {
		
	}
	static function makeLine3() {
		
	}
}

echo myName1::$opacity;
echo myName1::makeLine1(1,5151);



exit();
*/

/*
class paginator {
	static $howpages = 9;
	static $shownumber = true;
	static $shownext = true;
	
	static function showPaginator() {

		if(self::$howpages == 5) {
			echo 'Что-то своё';
		}
			// ...
		echo '1,2,3,4';
	}
}





paginator::showPaginator();


echo '<hr>';
*/

// В данном месте вывести (9)

// ...экземпляр...

// СТАТИКА self::$var;
// ЭКЗЕМПЛЯРУ $this->var;

// public, private, protected;

/*
class Illustrator {
	public $radius = 10;
	private $type = 'XML';
	
	public function makeGraphic() {
		$this->test();
		echo $this->radius;
	}
	private function test() {
		
	}
}

$test = new Illustrator;
$test->lala = 'Эксперимент';
echo '<pre>'.print_r($test,1).'</pre>';
var_dump($test);

/*
$ill1 = new Illustrator;
$ill2 = new Illustrator; 

$ill1->changeRadius(5);
$ill2->changeRadius(33);


$ill1->makeGraphic();
echo '<hr>';
$ill2->makeGraphic();

$var = 10; // int
$var = 10.2; // float
$var = 'text'; // string
$var = false; // bool boolean
$ill1 = new Illustrator; // object


$var = holodilnik::ohladit('Рыбу');
echo $var; // Охлажденная рыба


exit();

/*
$var1 = illustrator;
$var2 = illustrator;


$var1 = 'шар';
$var1['радиус'] = 10;

$var2 = 'квадрат';












//

echo $var1;
echo $var2;








exit();








/*
// Вторая область
class myName2 {
	$opacity = 100;
	$size = 30;
	
	function makeLine1() {
		
	}
	function makeLine2() {
		
	}
	function makeLine3() {
		
	}
}





















/*
foreach($array as $k=>$v) {
	if(is_array($v)) {
		foreach($v as $k2=>$v2) {
			$array[$k][$k2] = trim($v2);
		}
	} else {
		echo $k.'=>'.$v.'<br>';
		$array[$k] = trim($v);
	}
}
*/


/*
$res = q("SELECT * FROM `users` 
WHERE `id` = '1'1'
ORDER BY `id`");

$res = q("ЗАПРОС");

echo '<hr>';

$res = q("SELECT * FROM `users` ORDER BY `isd`");
if(mysqli_num_rows($res)) {
	echo 'Всего у нас на сайте '.mysqli_num_rows($res).' пользователей зарегистрировано<br>
	А именно:<ul>
	';
	$i = 0;
	while($row = mysqli_fetch_assoc($res)) {
		echo '<li>'.++$i.'. '.htmlspecialchars($row['login']).'</li>';
	}
	echo '</ul>';

} else {
	echo 'Нет записей';
}

exit();
/*
$row = mysqli_fetch_assoc($res);
echo 'Существует пользователь: '.$row['login'];
*/
