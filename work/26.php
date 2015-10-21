<?php
1. РЕВРАЙТ - ЧПУ - Mode Rewrite
2. Обфускация - ob_start, ob_clean
3. Динамические meta-данные CSS, JS
4. Ссылки: абсолютные, относительные, относительно корня сайта

///////////////////////////////// 
////////// ЧПУ  ////////////////
///////////////////////////////

//.htaccess

RewriteEngine on
// добавляем мсключения, т.е. те папки которые мы не обрабатываем!!!
// Для каких папок не будем применяться правила RewriteRule
RewriteCond %{REQUEST_URI} !^/admin
RewriteCond %{REQUEST_URI} !^/forum
RewriteCond %{REQUEST_URI} !^/ckeditor

RewriteCond %{REQUES_FILENAME} !-f
RewriteCond %{REQUES_FILENAME} !-d
// Автозамена
RewriteRule ^(.*)$ index.php?route=$1 [L,QSA]


RewriteCond %{REQUEST_URI} !^/admin
// если мы напишем  /admin/name/var
/admin/index.php (index.php попадет) <= $_GET['route'] = name/var
-> по-этому убираем это правило
// остается только
RewriteCond %{REQUEST_URI} !^/forum
RewriteCond %{REQUEST_URI} !^/ckeditor






// Для лучшего восприятия ссылки
next/cab/registration
// вместо
next/index.php?module=cab&page=registration


//variables.php
// смотрим что в $_GET
wtf($_GET);
// Если в адресной стороке мы напишем http://next/cab/registration
то в массив выведится:
Array
(
    [route] => cab/registration
)
// Теперь эту строчку необходимо разобрать по частям - поместить каждый элемент строки в массив
// 1-й элемент помещает в module
// 2-й элемент помещает в page

//  В адресной строке next/a/b/c
$_GET['module'] = a
$_GET['page']   = b
$_GET['key1']   = c

// Если никаких элементов нет, то ничего не обрабатываем
if(isset($_GET['route'])){
	// Функция разбивающая строку на массив
	$temp = explode('/',$_GET['route']);
	foreach($temp as $k => $v){
		$_GET['key_'.$k] = $v;
	}
	// можно убрать [route] => a/b/c
	unset($_GET['route']);
	wtf($_GET);
}
// Выведит
Array
(
    [route] => a/b/c
    [key_0] => a
    [key_1] => b
    [key_2] => c
)


if(isset($_GET['route'])){
	// Функция разбивающая строку на массив
	$temp = explode('/',$_GET['route']);
	// если $k == 0 т.е. первый -> индексный файл -> index.php
	foreach($temp as $k => $v){
		if($k == 0){
			$_GET['module'] = $v; // модуль
		} elseif($k == 1) {
			// делаем проверку - если ввести next/cab/ создастся 
			// page нет, но слеш поле cab/ говорит, что дальше будет идти $_GET['page']
/*			Array
			(
				[module] => cab
				[page] => 
			)
			// если переменная не пустая, то создастся переменная page  т.е. next/cab/ -> пустота
			Array
			(
				[module] => cab
			)		
*/			
				if(!empty($v)){
				$_GET['page'] = $v; // page
			}
		} else {
			$_GET['key_'.($k-1)] = $v; // key_1 | key_2 | key_3 
		}
	}
	// можно убрать [route] => a/b/c
	unset($_GET['route']);
	wtf($_GET);
}

// Теперь мы можем писать  В адресной строке next/cab/registration и попадать на страницу регистрацииArray
(
    [module] => cab
    [page] => registration
)
//т.е. то как устроено наше ядро

---> Это мы обработали наш REWRITE


// Открываем module - news
// main.tpl
// исправляем ссылку
<a href="/index.php?module=news&page=add">ДОБАВИТЬ НОВОСТЬ</a>
// на
<a href="/news/add">ДОБАВИТЬ НОВОСТЬ</a>

// исправляем ссылку
<a href="index.php?module=news&action=delete&id=<?php echo $row['id']; ?>">УДАЛИТЬ</a>
// можем писать / и работать с key_1 | key_2
//   /news/main/delete/10
<a href="/news/main/delete/<?php echo $row['id']; ?>">УДАЛИТЬ</a>
// т.е. мы бы работали как с переменной $_GET['key_1']

// main.php
// было
	if(isset($_GET['action']) &&  $_GET['action'] == 'delete'){
		mysqli_query($link,"
			DELETE FROM `news`
			WHERE `id` = ".(int)$_GET['id']."
		") or exit(mysqli_error($link));
		
		$_SESSION['info'] = 'Новость была удалена';
		header("Location: /index.php?module=news");
		exit();
	}
// стало
if(isset($_GET['key_1'], $_GET['key_2']) &&  $_GET['key_1'] == 'delete'){
		mysqli_query($link,"
			DELETE FROM `news`
			WHERE `id` = ".(int)$_GET['key_2']."
		") or exit(mysqli_error($link));
		
		$_SESSION['info'] = 'Новость была удалена';
		header("Location: /news");
		exit();
	}


<a href="index.php?module=news&action=delete&id=<?php echo $row['id']; ?>">УДАЛИТЬ</a>
// либо перед id ставим знак ?
// знак ? говорит о том, что мы дополняем к стандартным параметрам /news/delete - дополнительные параметры
<a href="/news/main?action=delete&id=<?php echo $row['id']; ?>">УДАЛИТЬ</a>

// в таком случае мы бы получили ссылку
/news/main?action=delete&id=10

// меняем ссылку редактировать
<a href="/news/edit?id=<?php echo $row['id']; ?>">РЕДАКТИРОВАТЬ</a>


// main.php
// переписываем header под ЧПУ
		$_SESSION['info'] = 'Новость была удалена';
		header("Location: /news");
		exit();


// У нас есть наш шаблон skins -> default 
// В нем есть все, если мы подгрузим другой шаблон, в нем так же будет находится все касаемо шаблона, картинки, стили т.д.
// default.php создаем папку 
// css
// img
// flash
// js

// Абсолютный путь к картинке
<img src="http://next/skins/<?php echo Core::$SKIN; ?>/img/logo.png">

// Относительный пути
<img src="skins/default/img/logo.png">


// Относительно корня сайта перед skins ставим /
<img src="/skins/<?php echo Core::$SKIN; ?>/img/logo.png">
// теперь мы можем переносить наш сайт с одного хостинга на другой
// перед /skins/ будем проставляться название сайта, а путь будет оставаться полным

// В config.php
static $JS   = array();
static $CSS  = array();
static $META = array(
	'title'=>'стандартный TITLE',
	'description'=>'d',
	'keywords'=>'k'
);


// index.tpl
?><head>
  <title><?php echo htmlAll(Core::$META['title']); ?></title>
  <meta name="description" content="<?php echo htmlAll(Core::$META['description']); ?>">
  <meta name="keywords" content="<?php echo htmlAll(Core::$META['keywords']); ?>">
  <link href="/css/style.css" type="text/css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

 </head >
<?php 
// мы можем изменить параметры описания ключевых слов и т.д. в любом модуле,
// например news -> main.php
Core::$META['title'] = 'Новый параметр';

// allpages.php
$res = q("
	SELECT *
	FROM `meta`
	WHERE '".stringAll($_GET['module'])."_".stringAll($_GET['page'])."'
	LIMIT 1
");
$row = mysqli_fetch_assoc($res);
Core::$META = $row;

// Бывает необходимость, применить стиль CSS только к определенной странице, тогда мы подключаем через класс
// например в модуле news -> main.php
Core::$CSS[] = '<link type="text/css" rel="stylesheet" href="/css/style.css">';

// выводим его
// index.tpl подключаем стили

?>
<?php if(count(Core::$CSS)){echo implode("\n",Core::$CSS)} ?>
<?php if(count(Core::$JS)){echo implode("\n",Core::$JS)} ?>
<?php 
// Если count вернет ноль - то событие не произойдет

JAVASCRIPT лучше всего подключать на той странице где его применяем, чтобы не перегружать сайт

// main.php
// -> говорит о том, что все что ниже ф-и не будет выводится, а будет записываться во временное хранилище
// временное хранилище (буфер обмена)
ob_start();
	// сюда отправляется только вывод echo (не обработка, а вывод)
	echo 'TEXT<br>';
	echo 'TEXT5<br>';
	// если напишем переадресацию, то она будет работать, потому что это не вывод echo
	//header("Location: /");
	// echo - записывается в переменную, достаем ее
	$content = ob_get_contents();
	
	echo 'TEXT3<br>';
	echo 'TEXT4<br>';
	$content2 = ob_get_contents();
ob_end_clean(); // закрывает ф-ю ob_start, данные больше не шранятся в буфере обмена
// echo 'TEXT2'; уже выводится на страницу

echo 'TEXT2';
echo '<br>'.$content2.'<br>'.$content;
// В $content2 - запишеться все что, находится выше $content2 = ob_get_contents();
TEXT
TEXT5
TEXT3
TEXT4
// В $content - запишеться все что, находится выше $content = ob_get_contents();
TEXT
TEXT5
exit();


ob_start();
	if($var == 5){
		echo 'text';
	}
	$content = ob_get_contents();
ob_end_clean(); // закрывает ф-ю ob_start, данные больше не шранятся в буфере обмена

echo '<div style="color:red">'.$content.'</div>';
//выведится тукст ошибки красным цветом который записался в буфер обмена
exit();

// index.php //Роутер
// Если вдруг какой-то текст будет выводится, то он не выведится, а попадет в переменную
ob_start();
	include './modules/allpages.php'; // подключаем проверку авторизации (забанен ли человек или нет)
	include './modules/'.$_GET['module'].'/'.$_GET['page'].'.php';   // подключаем контроллер
ob_end_clean(); 
	
include './skins/'.Core::$SKIN.'/index.tpl';    // подключаем шаблоны	$content = ob_get_contents();

//index.tpl
	<div class="conteiner">
	 <!--РОУТЕР-->
	 <?php echo $content; include $_GET['module'].'/'.$_GET['page'].'.tpl';?>          
	</div>
    
 <?php  
// Перенесем .tpl в index.php чтоб ы юыло видно с чем мы работаем<br>
ob_start();
	include './modules/allpages.php'; // подключаем проверку авторизации (забанен ли человек или нет)
	include './modules/'.$_GET['module'].'/'.$_GET['page'].'.php';   // подключаем контроллер
	include './skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';
	$content = ob_get_contents();
	// всё что выше попадает в $content - затем выводим $content в index.tpl
ob_end_clean(); 




	
include './skins/'.Core::$SKIN.'/index.tpl';    // подключаем шаблоны

//index.tpl
	<div class="conteiner">
	 <!--РОУТЕР-->
	 <?php echo $content; ?>          
	</div>

<?php
// Теперь если мы напишем 
if ($var == 10){
	echo 'Hello';
}
// То теперь ошибка не сломает наш HTML код, и выведится не в начале кода, а в середине

// index.tpl
// Ссылка на файл css
 <link href="/skins/<?php echo Core::$SKIN; ?>
 /css/style.css" type="text/css" rel="stylesheet">






