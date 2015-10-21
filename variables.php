<?php
if(isset($_GET['route'])){
	// Функция разбивающая строку на массив
	$temp = explode('/',$_GET['route']);
	// если 1-й элемент массива[0] == 'admin'
	// тот который мы передали 1-м ключом (next/admin)
	// подключаем админку
	if($temp[0] == 'admin') { // если кроме admin были бы еще другие модули, то можно
		// in_array($temp[0], array('admin','partners','adversment'))
		// меняем параметр $SKIN заменяем параметр с 'default' -> 'admin'
		Core::$SKIN = 'admin';
		Core::$CONT = Core::$CONT.'/admin';
		// убиваем значение $temp[0]
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

// Если не существует модуля, то по умолчанию он static
if(!isset($_GET['module'])){
	$_GET['module'] = 'static';
} else {
	$res = q("
		SELECT *
		FROM `pages`
		WHERE `module` = '".stringAll($_GET['module'])."'
		LIMIT 1
	");
	// Если нет в массиве такого модуля
	if (!$res->num_rows) {
		// переадресовываем на страницу 404
		header("Location: /404");
		exit();
	// Проверяем страницу, статичная она или не статичная
	} else {
		// Делаем выбоку из БД
		$staticpage = $res->fetch_assoc();
		// Выборку сделали и $res нам больше не нужна
		// Удаляем ссылку на соединение и очищаем память
		$res->close();
		// Если страница статичная
		if($staticpage['static'] == 1) {
			// Создаем модуль для статичных страниц staticpage
			$_GET['module'] = 'staticpage';
			$_GET['page']   = 'main';
		}
	}
}

if(!isset($_GET['page'])){
	$_GET['page'] = 'main';
}	


/*$allowed = array('static','admin', 'exit', 'errors','authorization','static','bitva_alcogolicov','fileManager', 'cab', 'reviews', 'news', 'goods', 'users');
// Если не существует модуля, то по умолчанию он static
if(!isset($_GET['module'])){
	$_GET['module'] = 'static';
}	
elseif(!in_array($_GET['module'], $allowed) && Core::$SKIN != 'admin'){
	header("Location: /errors/404");
	exit();
}

if(!isset($_GET['page'])){
	$_GET['page'] = 'main';
}	
*///убираем пробелы в начале и в конце введеных пользователем данных
/*if(isset($_POST) && count($_POST)){
	foreach($_POST as $k => $v){
	$_POST[$k] = trim($v);
	}
}	
*/
?>