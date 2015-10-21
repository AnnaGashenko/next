<?php
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');


// ЗАДАНИЕ_6
$array = array(
	'site.ru',
	'barakuda',
	'zimbabwe_ru',
	'zimbabwe',
	'zzz-zimbabwe',
	'http://site.ru',
	'www.site.com',
	'www.zimbabwe.com',
	'zimbabwe.com.ua',
	'http://zimbabwe.ru',
);
	 
// Осуществить проверку каждого слова на присутствие в начале http://, и там, где его нет - дописать.
$code = preg_quote('http://');
foreach ($array as $k => $v) {
	if(!preg_match('#^'.$code.'.+#ui',$v,$matches)) {
		$array[$k] = 'http://'.$v;
		echo $array[$k].'<hr>';
	} else {
		echo $array[$k].'<hr>';
	}
}

// Похожее задание, но для сайтов, где не указано доменное имя - дописать .ru, это продолжение предыдущего задания, делается так же само, в одном цикле, просто 2 отдельных условия!',

foreach ($array as $k => $v) {
	if(!preg_match('#(.+)\.[a-z]+$#ui',$v,$matches)) {
		$array[$k] = $v.'.ru';
		echo $array[$k].'<hr>';
	} else {
		echo $array[$k].'<hr>';
	}
}

// ЗАДАНИЕ_11
И последнее с email адресом
[01.11.2014 1:36:16] Станислав: У домена: inpost.dp.ua
Почтовый ящик:
admin@inpost.dp.ua
[01.11.2014 1:36:19] Станислав: именно 2 точки

$array = array(
	'text@',
	'yandex@@mega.com',
	'beer@mail.com',
	"inpost.dp.ua",
	"inpostdpua@gmail.com",
	"admin@inpost.dp.ua",
);


$q = array(
	'Проверить на валидность е-мейла. Краткая информация (ВАЖНАЯ!), емеил состоит из набора символов маленьких. 
	 Присутствует в центре собака, слева имя ящика, которое может состоять из обычных символов англ И подчеркивания И тире.
	 Справа находятся домены, отделенные точками.',
);

// РЕШЕНИЕ_11
foreach ($array as $v) {
	if(preg_match('#([a-z\_\-]+@[a-z]+\.[a-z]+\.?[a-z]*)#u',$v,$matches)) {
		echo 'Найден е-мейл: <b>'.$matches[0]. '</b><br>';
	}
}
