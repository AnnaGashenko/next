CMS - Content Management System (Система кправления контентом, или проще админка)
Content - вся информация которую видит пользовательна на сайте
Menedgment - подрозумевает под собой управление этим контентом
Управление (Menedgment) - ОБЯЗАТЕЛЬНО ВСЕ 3 ПАРАМЕТРА
	1. Создание данных (access = 2) - права доступа
	2. Редактироване данных (access = 2)
	3. Управление данными (access = 5)
	
ФРЕЙМ-ВОРКИ - это ядро сайта
libs 
skins
modules
index.php
config.php
variables.php
-> Не включает в себя CMS

-> Мы уже создали модуль news где, у нас есть добавление, редактирование и удаление новостей.
	-> Это такое начало вхождения в CMS 	
    
<?php	
// Обязательно нужно проверять права вначале иначе любой пользователь может 
// ввести в адресную строку запрос и удалить запись - даже без прав
// site.ua/index.php?action=delete&id=7 (например он введет в адресную строку)
if ('нажата кнопка' && $_SESSION['user']['access'] == 5) {
	удаляем новость;
}
// Выводим в цикле все новости
$res = q("запрос");
while($row = mysqli_fetch_assoc($res)) {
	echo 'Новость №'.$row['id'];
	// Если есть доступ -> вы админ, -> у вас доступ $access == 5
	if($_SESSION['user']['access'] == 5) {
		// Выведим кнопочку
		echo '<a>Удалить новость</a>';	
	}
	echo $row['text'];
}

-> Для удобства, мы выводим дополнительные кнопки (редактировать - удалить)на самом сайте
-> Чтобы наш админ не лез в админку или в БД и не искал его там, а сразу видя на сайте, мог  иметь доступ

-> Полезно иметь документацию, которая описывает функционал наших модулей, для людей к-е будут пользоваться нашим сайтом

-> У нашей админки будем другой дизайн (вид) чем у сайта, создаем отдельный шаблон для админки

-> Добавляем шаблон в папку skins -> папку admin 
-> копируем в папку admin - папку news и файл index.tpl

-> Чтобы шаблон подключался нужно подкорректировать ядро
-> Обычно после названия сайта дальше идет параметр - admin (www.next.com/admin)
-> Внутри папки modules -> создаем папку admin

-> Внутри папки admin -> создаем файл allpages.php
-> Внутри папки admin будут свои модули -> news

// variables.php
// распределим куда отправлять пользователей в данный момент
// next/admin/module/page
// из за admin сбился порядок next/admin-ключ0/module-ключ1/page-ключ2
// нужно изменить порядок module-ключ0/page-ключ1
// пересчитаем, то что у нас содержится в массиве $temp[0]

if(isset($_GET['route'])){
	// Функция разбивающая строку на массив
	$temp = explode('/',$_GET['route']);
	// если 1-й элемент массива[0] == 'admin'
	// тот который мы передали 1-м ключом (next/admin)
	// подключаем админку
	if($temp[0] == 'admin') { // если кроме admin были бы еще другие модули, то можно
		// in_array($temp[0], array('admin','partners','adversment'))
		// меняем параметр $SKIN заменяем параметр с 'default' -> 'admin'
		// если next/admin/module/page - то будет подключаться папка не skins->default, a skins ->admin
		// modules -> admin -> news
		Core::$SKIN = 'admin';
		// В случае админки будет modules/admin
		Core::$CONT = Core::$CONT.'/admin';
		// убиваем знасение $temp[0]
		unset($temp[0]);
	}
	// создаем временную переменную $i
	$i = 0;
	// если $k == 0 т.е. первый -> индексный файл -> index.php
	foreach($temp as $k => $v){
		// если $i == 0 ->  модуль
		if($i == 0){
			$_GET['module'] = $v; // module
		// если $i == 1 ->  page
		} elseif($i == 1) {
			// если переменная не пустая, то создастся переменная page  т.е. next/cab/ -> пустота
			if(!empty($v)){
			$_GET['page'] = $v; // page
			}
		} else {
			$_GET['key_'.($k-1)] = $v; // key_1 | key_2 | key_3 
		}
		++$i;
	}
	unset($_GET['route']);
}

// config.php
// Занесем modules в переменую $CONT
// В будущем мы можем менять имя modules на любое другое, занеся его в переменную мы меняем его всего 1 раз 
static $CONT = 'modules';

// index.php
ob_start();
	include './'.Core::$CONT.'/allpages.php'; // подключаем проверку авторизации (забанен ли человек или нет)
	include './'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php';   // подключаем контроллер
	include './skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';
	$content = ob_get_contents();
ob_end_clean(); 

// index.tpl
// у default своя css - у admin своя - чтобы не подгружать все стили и не перегружвть страницу кодом
  <link href="/skins/<?php echo Core::$SKIN; ?>/css/style.css" type="text/css" rel="stylesheet">

// variables.php
// Чтобы не перегружать систему устанавливаем правило
// Если это не админка, то проверяем наличие допустимых модулей

$allowed = array('static','main','girl', 'boy', 'newborn', 'admin', 'exit', 'errors','authorization',
'static','bitva_alcogolicov','fileManager', 'cab', 'reviews', 'news', 'goods');
if(!isset($_GET['module'])){
	$_GET['module'] = 'static';
}	
elseif(!in_array($_GET['module'], $allowed) && Core::$SKIN != 'admin'){
	header("Location: /errors/404");
	exit();
}

// в skins ->admin переносим папки css; js; img; flash

// Для входа в админку нашей CMS всегда нужно спрашивать логин и пароль
modules -> admin -> static -> main.php


// Для входа в админ
/admin/goods/news
/admin/$_GET['module']/$_GET['page']

АДМИНКА:
Новости {
	1. Создавать
	2. Редактировать
	3. Удалять
}
/goods/news
/$_GET['module']/$_GET['page']

ДЛЯ ВСЕХ:
Новости: {
	1. Вывод всех новостей
	2. Страница конкретной новости, читать подробнее
}
-> Удаляем файлы edit.php/edit.tpl add.php/add.tpl из admin -> news

//.htaccess
# Не используем реврайт для определенных папок
RewriteCond %{REQUEST_URI} !^/admin
RewriteCond %{REQUEST_URI} !^/forum
RewriteCond %{REQUEST_URI} !^/ckeditor

// но внутри папки реврайт будет работать нормально
/admin/name/var

// С этим правилом RewriteCond %{REQUEST_URI} !^/admin
// запустится index.php в него попадет $_GET['route'] с содержанием name/var
// Это если мы хотим хранить index.php в папке admin
/admin/index.php <- $_GET['route'] = name/var
-> убираем RewriteCond %{REQUEST_URI} !^/admin
т.к у нас обращается c index.php -> в variables.php 
-> слэш который идет в начале должен попадать именно в $_GET['route']
-> т.е. никаких дополнительных папок не надо
-> по-этому правило лишнее убираем RewriteCond %{REQUEST_URI} !^/admin


//modules-admin-static-main.php
// При входе в админку нужно авторизация next/admin/auth
// Если отсутствует авторизация (мы не авторизированы) или у нас нет прав
if(!isset($_SESSION['user']) || $_SESSION['user']['rights']) != 5) {
	
}
// skins-admin-index.tpl
// Если есть права, то выводим в админке навигацию, новости, главная
<?php if(!isset($_SESSION['user']) && $_SESSION['user']['rights']) == 5) { ?>
 <ul class="nav">
   <li><a href="/admin">ГЛАВНАЯ</a></li>
   <li><a href="/admin/reviews">ОТЗЫВЫ</a></li>
   <li><a href="/admin/news">НОВОСТИ</a></li>
   <li><a href="/admin/goods">ТОВАРЫ</a></li>
 </ul>
<?php } ?>


<?php
// skins-admin-main.tpl
// подключаем авторизацию из cab/auth.tpl
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5 ) { 
	include './skins/default/cab/auth.tpl';
}

// module-admin-static-main.php
// подключаем авторизацию
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5 ) { 
	include './modules/cab/auth.php'; 
}


//modules->admin->allpages.php
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5 ) { 
	// Например у человека нет прав ['user']['access'] != 5 и он пытается открыть другую страницу кроме главной
	if($_GET['module'] != 'static' || $_GET['page'] != 'main') {
		// Делаем переадресацию на главную
		header("Location: /admin/static/main");
		exit();
	}
}

// variables.php
// Если прописать в адресной строке http://next/admin/ (после admin слэш)
// admin воспрнимает как admin, а / - как пустая строка, но за админом идет модуль (по-этому выдает ошибку)
// Проверяем, если модуль не пустой if(!empty($v)){$_GET['module'] = $v; }
if(isset($_GET['route'])){
	$temp = explode('/',$_GET['route']);
	
	if($temp[0] == 'admin') { // если кроме admin были бы еще другие модули, то можно
		Core::$SKIN = 'admin';
		Core::$CONT = Core::$CONT.'/admin';
		unset($temp[0]);
	}
	
	$i = 0;
	// если $k == 0 т.е. первый -> индексный файл -> index.php
	foreach($temp as $k => $v){
		if($i == 0){
			if(!empty($v)){
				$_GET['module'] = $v; // модуль
			}
		} elseif($i == 1) {
			// если переменная не пустая, то создастся переменная page  т.е. next/cab/ -> пустота
			if(!empty($v)){
				$_GET['page'] = $v; // page
			}
		} else {
			$_GET['key_'.($k-1)] = $v; // key_1 | key_2 | key_3 
		}
		++$i;
	}
	unset($_GET['route']);
}
// Теперь даже если мы поставим после admin / -> будет восприниматься как модуль не существует
// Тогда будет обрабаться этим правилом
$allowed = array('static','main','girl', 'boy', 'newborn', 'admin', 'exit', 'errors','authorization',
'static','bitva_alcogolicov','fileManager', 'cab', 'reviews', 'news', 'goods');
if(!isset($_GET['module'])){
	$_GET['module'] = 'static';
}	
elseif(!in_array($_GET['module'], $allowed) && Core::$SKIN != 'admin'){
	header("Location: /errors/404");
	exit();
}


 
ДОМАШКА
1. admin/index/tpl <- сделать шаблон админки
2. распределение на 2 модуля (модуль админки и модуль "для всех")















