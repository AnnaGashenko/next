<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>

<script>

function myAjax() {
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		data: {login: 'inpost'},
		success: function() {
			var response = JSON.parse(msg);
			alert(response.name + ',' + response.surname);
		},
	});
	return false;
}





</script>







<?php
/*
$array = array(
	'inpost',
	'Barabulka_ru',
	'Zimbabwe.ru',
	'Max',
	'Yojik',
	'Иван Тарасов',
	'Ёжик',
	'Борис Николаевич Кощуновский',
	'Ооооооооооооооооооооочень длинное имя',
	'Я',
	'go->drink->die',
	'Don`t sleep',
	'<Пивасик',
	'1',
	'123456789',
	'77777',
	'7ф777я7',
);
foreach ($array as $v) {
	if (preg_match("#^[a-zа-я\_\-\s]{4,15}$#ui",$v,$matches)) {
		echo 'Найден файл: <b>'.$matches[0]. '</b><br>';
	}
}
/*
// Чтобы код работал
class MyTest{
	public $property;
	
	function getResult($property){
		// передаем внутри метода значение 5 для объекта $property
		$this->property = $property = 5;
		return $this->property;	
	}
}

$myTest = new MyTest;
echo $myTest->property;

/*
function foo() {
// вернет число переданных документов
	// echo func_num_args(); // вернет 3
	// получаем аргументы
	// с помощью ф-и func_get_args - получаем массив
	$args = func_get_args();
	print_r($args);
}

foo('a',25,true);






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

_______________________________________________________________________
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
function getMenu($menu,$vertical=true){
	// стиль меню
	$style = '';
	// если $vertical не true ($vertical=false)
	// отрисуется горизонтальное меню
	if(!$vertical){
		$style = ' style="display:inline;margin-right:15px;"';
	}
	echo '<ul style="list-style-type:none">';
	foreach($menu as $link => $href) {
		echo '<li'.$style.'><a href='.$href.'>'.$link.'</a></li>';
	}
	echo '</ul>';
}

// Вертикальное меню
getMenu($v_menu);

// Горизонтальное меню
getMenu($h_menu,false);


// Можно задавать параметры по умолчанию
function sayHello($name="Гость") {
	echo 'Hello, '.$name.'<br>';	
}

// Вызываем функцию, вариант 1
sayHello('Иван');
// Вызываем функцию, вариант 2
sayHello('Петр');
// Вызываем функцию, вариант 3
sayHello();


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
								//Сохраняем полученное изображение в формате JPG
								imagejpeg($dst, '.'.$tmp_path .'small_'.$name, 100);
								// Освобождаем память
								imagedestroy($src);
							}
						
					}
				} else {
					echo 'Данный файл не является картинкой';	
				}
			}
		}
	}
}
?>

<!--Для того чтобы была возможность загружать файлы устанавливаем enctype="multipart/form-data"
иначе файлы не будут загружаться
--><form action="" method="post" enctype="multipart/form-data">
  <!--Поле для ввода имени файла, который пересылается на сервер-->
  <input type="file" name="file">
  <input type="submit" name="submit" value="загрузить файл">
</form>*/
