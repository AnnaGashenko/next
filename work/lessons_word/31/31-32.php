<!--
// Сейчас у нас путь прописывается 
/static/contacs

// Удобнее если будет 
/contacs
-->

<?php
/* // variables.php
 
$allowed = array('static','admin', 'exit', 'errors','authorization','static','bitva_alcogolicov','fileManager', 'cab', 'reviews', 'news', 'goods', 'users');
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
*/

// Изменяем
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
	if (!mysqli_num_rows($res)) {
		// переадресовываем на страницу 404
		header("Location: /404");
		exit();
	// Проверяем страницу, статичная она или не статичная
	} else {
		$staticpage = mysqli_fetch_assoc($res);
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






















// Если бы у нас был сайт который распределяется на несколько баз данных
// то такой запрос не подойдет, т.к. тут обращаемся только к одной БД
$res = mysqli_query($link, "SELECT NOW()");
$res = q("SELECT NOW()");

// На тот случай если у нас будет несколько БД
 
class DB {
	// массив для работы с несколькими БД
	static public $mysqli = array();
	static public $connect = array();
	
	// Создаем функцию соединения с БД
	// Передаем ключ $key, с какой БД мы будем работать
	public function _($key = 0) {
		// Если нет соединения, то создаем новое соединение
		if(!isset(self::$mysqli[$key])) {
			// Если мы не передаем значение $connect['server']
			// то подставятся дефолтные
			if(!isset(self::$connect['server'])) 
				self::$connect['server'] == Core::$DB_LOCAL;
			if(!isset(self::$connect['user'])) 
				self::$connect['user'] == Core::$DB_LOGIN;
			if(!isset(self::$connect['pass'])) 
				self::$connect['pass'] == Core::$DB_PASS;
			if(!isset(self::$connect['db'])) 
				self::$connect['db'] == Core::$DB_NAME;
			
			// передаем дефолтные параметры: имя пользователя; 	
			// скрываем стандартный вывод ошибок
			self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']);
			// прописываем нашу ошибку
			if(mysqli_connect_errno()) {
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
	// пишем ф-ю закрывающую соединение с именем $key
	static public function close($key = 0) {
		// close() методы класса самого mysqli
		// mysqli::close -- mysqli_close — Закрывает ранее открытое соединение с базой данных
		self::$mysqli[$key]->close();
		// Убиваем елемент массива в котором было соединение
		unset(self::$mysqli[$key]);
	}
}

// Cоздаем соединение с БД
DB::_();

1. Если соединение уже установленно, $mysqli[$key = 0]
- возвращаем наше соединение return self::$mysqli($key);

2. Если соединения еще нет DB::$mysqli[1] т.е. ключ $key = 1
- создаем новое соединение if(!isset(self::$mysqli[$key]))
- и возвращаем его return self::$mysqli($key);

3. Наш return возвращается в DB::_();
4. После этого мы к нашему соединению return self::$mysqli($key);
ссылаемся с запросом query();

// Делаем запрос к БД
DB::$mysqli[0]->query("запрос");

// Объединяем и соединение с БД и запрос к БД
// для это прописываем в классе  return self::$mysqli($key);
DB::_($key)->query();

// подключаемся к классу DB:: 
// передаем значение ключа $mysqli[0](к какой БД подсоединиться)
// set_charset("") - передаем кодировку
DB::$mysqli[0]->set_charset("");

// Если мы не передаем ключ, то подключаем 1-ю БД (дефолтную ($key = 0))
q("SELECT NOW()");
// Если передаем ключ, то подключаем 2-ю БД
q("SELECT NOW()",'какой-то_ключ');
q("SELECT NOW()",'link');



DB::_()->query("запрос");
DB::close();

....
....
....
// Для работы с графикой необходимо закрывать соединение
// Пусть другие пользователи используют соединение пока оно нам не нужно
ОБРАБАТЫВАЕМ ФОТОГРАФИИ
....
....
....
....

// Следующее соединени открывается при запросе к БД
q();

----------------  ПЕРЕДЕЛЫВАЕМ ФУНКЦИЮ q ---------
// Функция вывода ошибок
function q($query) { 
    global $link;
	$res = mysqli_query($link, $query);
	if($res === false) {
		$info = debug_backtrace();
//		wtf($info);
		$error = "QUERY: ".$query.'<br>'.mysqli_error($link)
			.'<br> <b>Ошибка найдена в файле:</b> '.$info[0]['file']
			.'<br> <b>На линии номер:</b> '.$info[0]['line']
			.'<br> <b>Дата и время:</b> '.date("d-m-Y H:i:s");
		// Отправку уведомления на почту
		// Логировать ошибки (записывать их в файл)
		file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
		echo $error;
		exit();
	}
		return $res;
}

// СТАЛО
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

// Мы создали функцию q как АЛИАС и расширили ее функционал
// Но могли бы писать длинее
DB::_()->query("ЗАПРОС");


----------------  ПЕРЕДЕЛЫВАЕМ ФУНКЦИЮ stringAll ---------
// Создаем функцию для обработки массива, экранируем все символы
function stringAll($element) {
	global $link;
	// если $element не массив
	if(!is_array($element)) {
		$element = mysqli_real_escape_string($link,$element);
	} else {
		$element = array_map('stringAll', $element);	
	}
	return $element;
}
___________________________________

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
/*
ALIAS:
q(); Запрос к БД
// Функция для обработки массива, экранируем все символы
stringAll(); mysqli_real_escape_string

РАБОТА С ОБЪЕКТОМ ВЫБОРКИ
$res = q(); // Запрос с возвратом результата
$res->num_rows; // Количество возвращенных строк - вместо mysqli_num_rows();
$res->fetch_assoc(); // Достаем запись - вместо mysqli_fetch_assoc(); 
$res->close(); // Очищаем результат выборки

РАБОТА С ПОДКЛЮЧЕННОЙ MYSQL
DB::_()->affected_rows; // Количество измененных записей
DB::_()->insert_id; // Последний ID вставки
DB::_()->query(); // аналог q
DB::_()->multi_query(); // Множественные запросы
DB::_()->real_escape_string(); аналог stringAll();

DB::close(); // ЗАКРЫВАЕМ СОЕДИНЕНИЕ С БД
*/

$res->close(); // Очищаем результат выборки

Мы могли например выбрать из БД 10 записей
на 1 МБ - после мы с ним поработали
- больше нам выбранные записи из БД не нужны, мы уже вывели текст
- теперь мы хотим поработать и вывести другой текст
- делаем другой запрос уже к другой таблице нашей БД
- и достаем ещё 1 МБ
- и происходит то, что наш скрипт уже съел уже 2 МБ
- и память забита уже на 2 МБ
- ещё один запрос и уже 3 МБ и т.д.

Если мы будем очищать $res->close();
- то тот 1 МБ с которым мы поработали, он будет очищаться
- ЗАПРОС = 1 МБ -> поработали -> очистили $res->close(); -> 0 МБ

т.к. сколько скрипт скущал ресурсов (сколько занял памяти)

----------------- НАШ НОВЫЙ ЗАПРОС --------------

$res = q("SELECT NOW()");
// $res - является объектом
while($row = $res->fetch_assoc()) {
	wtf($row,1);
}
$res->close();
exit;
-------------------------------------------------

// БЫЛО
$goods = q("
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
");
while($row = mysqli_fetch_assoc($goods)) {
	//.........
}
_______________

// СТАНЕТ
$goods = q("
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
");
while($row = $goods->fetch_assoc()) {
	//........
}
$goods->close();
exit;

-------------------------------------------------

$res = q("SELECT NOW()");
// $res - является объектом
while($row = $res->fetch_assoc()) {
	wtf($row,1);
}
$res->close();
exit;

// Создаем новый запрос и значит старый нам больше не нужен
// По-этому мы его удалили (очистили) $res->close();
$res = q();


// variables.php

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
	if (!mysqli_num_rows($res)) {
		// переадресовываем на страницу 404
		header("Location: /404");
		exit();
	// Проверяем страницу, статичная она или не статичная
	} else {
		$staticpage = mysqli_fetch_assoc($res);
		// Если страница статичная
		if($staticpage['static'] == 1) {
			// Создаем модуль для статичных страниц staticpage
			$_GET['module'] = 'staticpage';
			$_GET['page']   = 'main';
		}
	}
}

------ ПЕРЕДЕЛЫВАЕМ НА НОВЫЙ СТИЛЬ -----

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


// index.php

$res = q("SELECT NOW()");
// $res - является объектом
while($row = $res->fetch_assoc()) {
	wtf($row,1);
}
$res->close();
DB::close();
echo 'Всё ОК!';
exit;

-----------------------------------------------

// Чтобы подсоединится к другой БД
$res = q("SELECT NOW()",'live2');
// перезаписываем значения
DB::$connect['user'] = '111';
DB::$connect['pass'] = '222';
DB::$connect['db'] = 'name_db';



--------- СОЗДАЕМ КАТЕГОРИИ В БД ------------


Мы делеали категории в массиве
//Создаем массив с категориями
$category = array('Холодильники', 'Пылесосы','Телевизоры');
// как это может быть у нас
$category = array('ASUS', 'APPLE','SONY');
- категории должны существовать отдельно от товаров

-- А, что если завтра админу нужно добавить еще одну категорию?
он не должен лезть в скрипт и добавлять ее в массив

-- Переносим массив в БД и храним его там

1. создаем новую таблицу goods_cat (id, name)
2. прописываем категории 
- ASUS
- SONY
- APPLE
2.1 Мы перенесли наш массив в БД

3. Делаем запрос к БД
$res = q("
	SELECT *
	FROM `goods_cat`
	ORDER BY `id`
");
// если это список
echo '<select name="cat">';
while($row = $res->fetch_assoc()) {
	echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
}
echo '</select>';
$res->close();


-------- СВЯЗЬ ОДИН КО МНОГИМ ---------
У одного товара может быть только 1 категория
не может быть у 1 товара несколько категорий

В одной категории может быть сколько угодно товаров!!!

1-й вариант 
- в таблице с товарами goods в поле cat 
прописываем категорию к которой пренадлежит товар

+ этого варианта:
 мы сразу можем вывести категорию
$res = q("
	SELECT *
	FROM `goods`
	WHERE `id` = 1
");
$row = $res->fetch_assoc();
echo 'Данный ноутбук относится к категории: '.$row['cat'];

- этого варианта:
например у нас 10 млн. товаров
и в названии категории была допущена ошибка
у нас категории ASER, а менеджер записал как ASUS
------------------------------------------------------------

Делаем запрос, чтобы установить категорию ASUS

q("
	UPDATE `goods_cat` SET
	`name` = 'ACER'
	WHERE `id` = 1
");

Делаем 2-й запрос, чтобы изменить категорию ASUS на ASER

q("
	UPDATE `goods` SET
	`name` = 'ACER'
	WHERE `name` = 'ASUS'
");

- А если нужно менять не все, а только определенную часть
- если у нас не стоит индекс выборки по полю name, 
то выборка будет идти по всем товаром, а если у нас их 1 млн. ?!!
Это огромная нагрузка!!!

ТАКОЙ СПОСОБ МОЖНО ИСПОЛЬЗОВАТЬ ЕСЛИ ТЫ ЗНАШЬ ЧТО ТОВАРОВ БУДЕМ МАЛО, НАПРИМЕР 10

-------------------- 2-й вариант ---------------------
Прописываем id категории

+ Теперь мы можем менять название категорий и они автоматически меняются и в товарах, т.к. id остается
- При запросе выведится цифра 1 = id
$res = q("
	SELECT *
	FROM `goods`
	WHERE `id` = 1
");
$row = $res->fetch_assoc();
echo 'Данный ноутбук относится к категории: '.$row['cat'];

- это нам не подходит, т.к. должно выводится категория товара

$res = q("
	SELECT *
	FROM `goods`
");
while($row = $res->fetch_assoc()) {
	$res2 = q("
		SELECT `name`
		FROM `goods_cat`
		WHERE `id` = ".$row['cat']."
	");
	$row2 = $res2->fetch_assoc();
	echo 'Данный ноутбук относится к категории: '.$row2['name'];
}
Чтобы получить какуету категорию, нам каждый раз нужно делать дополнительный запрос к БД
Если у нас 100 товаров, то мы сделаем 100 запросов
Это постоянно придется дергать БД
А если зайдут 2 человека, то это уже 200 запросов
Но так категорически делать нельзя, иначе мы повалим нашу БД


--------------- 3-й вариант смежный ----------------

В таблицу `goods` добавляем поле cat_id

1. id категории нам может пригодиться если мы будем использовать дополнительные описания
- в таблице goods_cat добавляем поле text 
- нам нужен id чтобы получить полный текст описания категории

-> с одной стороны мы дублируем материал, нарушаем уникальность
-> но с другой стороны мы создаем оптимизированный запрос
чтобы избавиться от внутренних запросов

- И тогда запрос будет выглядить вот так:
$res = q("
	SELECT *
	FROM `goods`
");
while($row = $res->fetch_assoc()) {
	echo 'Данный ноутбук относится к категории: '.$row['name'];
}



-------------------- СЛОЖНЫЙ МЕХАНИЗМ СВЯЗЕЙ МНОГИЕ КО МНОГИМ --------------

1 товар может пренадлежать ко многим категориям
- товар Acer 101 принадлежит:
							- ноубуки
							- Acer
							- 13 дюймов
							- и т.д.



2. Создаем таблицу `goods2goods_cat`
это связь между таблицей goods и таблицей goods_cat

из таблицы books_authors выводим информацию об авторе
- Первый запрос к таблице books_authors (известен id)
$res = q("
	SELECT *
	FROM `books_author`
	WHERE `id` = 2
");
Обращаемся к таблице books2books_authors и достаем id авторов
-- Второй запрос к таблице books2books_author
$res = q("
	SELECT *
	FROM `books2books_author`
	WHERE `author_id` = 2
");

--- 3-й запрос
$res = q("
	SELECT *
	FROM `books`
	WHERE `id` IN (1,2)
");

Если мы хотим узнать автора книги, заходим в таблицу books2books_author и смотрим id - автора
1.
if(isset($_GET['id'])){
	$res = q("
		SELECT *
		FROM `books_author`
		WHERE `id`    = '".intAll($_GET['id'])."'
		LIMIT 1
	 ");
}
2. 
$res = q("
	SELECT *
	FROM `books2books_author`
	WHERE `author_id` = `'".intAll($_GET['id'])."'
");

$res = q("
	SELECT *
	FROM `books`
	WHERE `id` = book_id
");

---------------------------------------------------------------------
У НАС есть ID товара
if(isset($_GET['id'])){
	$res = q("
		SELECT *
		FROM `books`
		WHERE `id` = '".intAll($_GET['id'])."'
		LIMIT 1
	");
	С ним мы обращаемся к связующей таблице
	достаем ID категорий из связующей таблицы  books2books_author
	$res2 = q("
		SELECT *
		FROM `books2books_author`
		WHERE `book_id` = ".$row['id']."
	");
	с этими ID категорий обратиться в таблицу категорий
	$res3 = q("
		SELECT *
		FROM `books_author`
		WHERE `id` = ".$row['book_id']."
	");
}





$res = q("
	SELECT *
	FROM `goods`
");
while($row = $res->fetch_assoc()) {
	$res2 = q("
		SELECT `name`
		FROM `goods_cat`
		WHERE `id` = ".$row['cat']."
	");
	$row2 = $res2->fetch_assoc();
	echo 'Данный ноутбук относится к категории: '.$row2['name'];
}















// Оператор IN в SQL позволяет нам выбрать сразу несколько значений.

ПОСЛЕ 3 ЗАПРОСА МЫ МОЖЕМ ВЫВЕСТИ все книги которые написал автор

ДОМАШКА

1. НОВОСТИ (один ко многим) (всего 2 таблицы) 
Создаем в админке управление новостями
- добавить
- редактировать
- удалить
И публичный просмотр:
-вывести все новости
- и на этой же странице вверху можно выбрать категорию
кликнув по ней выводятся новости этой категории
а) научные
б) криминальные
в) политические

2. Книги (Многие ко многим)(всего 3 таблицы) 
Книги и авторы
- Админка и публично
- при выборе книги выводим ее автора
- при выборе автора выводим список книг этого автора

3. Пагинатор или для новостей или для книг





if(isset($_GET['id'])){
	$res = q("
		SELECT *
		FROM `books`
		WHERE `id` = '".intAll($_GET['id'])."'
		LIMIT 1
	");
	while($row = $res->fetch_assoc()) {
		$res2 = q("
			SELECT *
			FROM `books2books_author`
			WHERE `book_id` = ".$row['id']."
		");
		while($row2 = $res2->fetch_assoc()) {
			$res3 = q("
				SELECT *
				FROM `books_author`
				WHERE `id` = ".$row2['book_id']."
			");
		}
	}
}




Так  как в таблице books и books2books_authors id = book_id
когда кликая на книгу получаем ее $_GET['id']
то смело можем запрос делать к таблице books2books_authors

if(isset($_GET['id'])){
	$res = q("
		SELECT *
		FROM `books2books_authors`
		WHERE `book_id` = ".$_GET['id']."
	");
}






SELECT  `books`.`id` ,  `books2books_author`.`author_id` 
FROM  `books` 
INNER JOIN  `books2books_author` ON  `books`.`id` =  `books2books_author`.`book_id` 
LIMIT 0 , 30

if(isset($_GET['id'])){
	$res = q("
		  SELECT books_author.id, books_author.author
          FROM books_author
            INNER JOIN books2books_author
          ON books2books_author.author_id = books_author.id
            LEFT JOIN books
          ON books.id =  books2books_author.book_id
          WHERE books.id = ".$_GET['id']."
		 ");
}
if($res->num_rows) {
	while($row = $res->fetch_array()) {
		$autors .= "<a href='index.php?id=".$row['id']."'>".$row['author']."</a>, ";
	}
echo substr($autors, 0, -2);
}


------------Пагинатор----------
LIMIT 10, 5 //  означает, что мы воводим начиная с 10 записи, 5 записей

$limit =10;
// Если у нас первая страница
1 = 0,9 // выводим с 0 по 9 страницу
1*10-10 = LIMIT 0, $limit
// как расчитать 
2 = 9,19; 2*10-10 = LIMIT 10, $limit// получаем первую часть
3 = 19,29; 3*10-10 = LIMIT 20, $limit// получаем первую часть

________________________________________
where:
$limit = 10;
1 = 0,9; 1 * $limit - $limit = LIMIT 0, $limit
// как расчитать 
2 = 9,19; 2 * $limit - $limit = LIMIT 10, $limit
3 = 19,29; 3 * $limit - $limit = LIMIT 20, $limit

and: 1,2,3 = $GET['num']
в $GET['num'] передаем номер страницы на той на которой находимся
если $GET['num'] = 5 то 5 = 5 * $limit - $limit = LIMIT 40, $limit
5 = 39,49

///////////// КАК ЭТО ВЫГЛЯДИТ ///////////

site.ru/news/main?cat=POLITIC&num=5
- cat=POLITIC // категория товара
- num=5 // страница на которой находится клиент


// Вывод кнопок
$_GET['num'] - это та часть где мы сейчас находимся
до $_GET['num'] выводим 4 страницы и после
если после 4 страниц не 1, то выводим ... и страницу 1
создаем все в цикле


// кнопка previwe
$_GET['num'] - 1
// next
$_GET['num'] + 1


	$limit = 3;// Количество записей на странице
	$shift = $limit * ($_GET["num"] - 1);// Смещение в LIMIT. Те записи, порядковый номер которого больше этого числа, будут выводиться.
	$res = q("
		SELECT *
		FROM `news` 
		LIMIT $shift, $limit
	");
	while($row = $res->fetch_assoc()) {
		print_r($row);
		echo "<br />";
    }



 // Запрос к Базе данных - Выводим все новости
 $res = q("
  SELECT *
  FROM `news`
  WHERE `cat` = '".stringAll($_GET['cat'])."'
 ");
// узнаем сколько записей всего 
if($count = $res->num_rows) {
   $limit = 2;
   // вычисляем сколько страниц получилось 
   $count_pages = ceil($count/$limit);
 }

// считаем сколько новостей в БД
 



