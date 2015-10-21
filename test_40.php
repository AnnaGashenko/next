<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

<?php

/*Добрый день! Помогите пожалуйста вытащить из текста переменные, те $latinicaNum[начиная с доллара и заканчивая символом после которого встречается не латиница, не цифра, не подчеркивание](В примере вытащить $sssss123).*/


/*


$url = 'http://next/reviews';                                // URL сайта на котором будем авторизоваться
$login = 'TEST';  
$email = 'test@mail.ru';  
$text = 'TEST';                      // Ваш логин
$post = 'login=' . $login . '&email=' . $email. '&text=' . $text;  // POST данные

$ch = curl_init();                              // Инициализируем сеанс CURL
curl_setopt($ch, CURLOPT_URL, $url);            // Заходим на сайт
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Делаем так, чтобы страница не выдавалась сразу в поток, а можно было ее записать в переменную
$html = curl_exec($ch);                         // Имитируем заход на сайт

curl_setopt($ch, CURLOPT_URL, $url);              // Устанавливаем адрес куда будем слать POST данные
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  // Записываем cookies в файл, чтобы потом можно было их считать
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt'); // Теперь читаем cookies с файла
curl_setopt($ch, CURLOPT_POST, true);               // Говорим, что информация будет отправляться методом POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);        // Передаем POST данные
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);     // Иногда бывает, что после отправки данных происходит редирект header('Location:...'). 
                                                    // Этот параметр говорит о то, чтобы мы следовали за ними, а не оставались на месте после отправки данных

$html = curl_exec($ch); // Записываем пришедшие данные в переменную    
curl_close($ch);        // Закрываем сеанс работы CURL
echo $html;             // И вуаля :) Выводим авторизованную страницу









// Для началом работы с инструментом, его нужно инициализировать. Делается это следующим образом:
$ch = curl_init();
// Мы использовали функцию инициализации сессии cURL. При этом, можно задать URL сразу, вот так: 
// $ch = curl_init('http://myblaze.ru'); 
$url = "http://alexander.school-php.com/index.php?module=comments";
// curl_setopt -- Устанавливает параметр для сеанса CURL
// CURLOPT_URL: URL, с которым будет производиться операция
curl_setopt($ch, CURLOPT_URL,$url)

// Еще парочка примеров задания опций: давайте получим заголовок ответа сервера, пир этом не будем получать саму страницу:

curl_setopt($ch, CURLOPT_HEADER, 1); // читать заголовок
curl_setopt($ch, CURLOPT_NOBODY, 1); // читать ТОЛЬКО заголовок без тела

// Итак, мы инициализировали сессию, задали нужные нам параметры, теперь выполняем получившийся запрос, закрываем сессию и выводим результат:

$result = curl_exec($ch);  // Выполнить полученный запрос 
curl_close($ch); // Завершить сессию
echo $result; // Выводим результат

// В итоге получаем наш первый полностью рабочий пример использования библиотеки libcurl:

$ch = curl_init();
$url = "http://myblaze.ru";
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1); // читать заголовок
curl_setopt($ch, CURLOPT_NOBODY, 1); // читать ТОЛЬКО заголовок без тела
$result = curl_exec($ch);  // Выполнить полученный запрос
curl_close($ch); // Завершить сессию
echo $result; // Выводим результат


// При этом на выходе получим массив с заголовком, содержимым страницы и даже коды ошибок, если что-то пойдет не так.
function get_web_page( $url )
{
  $uagent = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36";

  $ch = curl_init( $url );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
  curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
  curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/cookie.txt');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
  curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
  curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
  curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа

  $content = curl_exec( $ch ); // Выполнить полученный запрос
  $err     = curl_errno( $ch ); 
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch ); // Завершить сессию

  $header['errno']   = $err; //если что-то пошло не так, то тут будет код ошибки.
  $header['errmsg']  = $errmsg; // здесь при этом будет текст ошибки.
  $header['content'] = $content; // обственно сама страница\файл\картинка и т.д.
  return $header;
}

// Используем функцию, например, так:

$result = get_web_page( "http://next/reviews" );
if (($result['errno'] != 0 )||($result['http_code'] != 200)){
	echo $result['errmsg'];
} else {
	$page = $result['content'];
	echo $page;
}
*/

/*
function auth( $url )
{
  $uagent = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36";
  $ch = curl_init( $url ); 
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/cookie.txt');
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "name=ann_gashenko&email=ann.gashenko");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу  
  curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
  curl_exec ($ch);
  curl_close( $ch );
}

//Все, теперь перед нашим циклом, который получает странички и парсит их, достаточно авторизоваться:
$result = auth("http://alexander.school-php.com/index.php?module=comments");






Великолепно! Мы получили заголовок ответа от сервера и опробовали библиотеку в действии. Чем это нам полезно? Тем, что теперь вы примерно представляете себе последовательность действий при работе с cURL:

Инициализировать сессию (curl_init)
Задать нужные нам опции (curl_setopt)
Выполнить полученный запрос (curl_exec)
Завершить сессию (curl_close)



/*$url = 'http://lib.wm-panel.com/';                        // Куда зайти
$urlTo = 'http://lib.wm-panel.com/wm-panel/user/signin';                   // Куда данные послать
$login = 'anyabelaya21@mail.ru';                                   // Логин
$pass = 'jA7jFuk5seFK';                                       // Пароль                                      // Домен
$post = 'log=' . $login . '&pas=' . $pass;         // POST данные

$ch = curl_init();                                        // Инициализация сеанса
curl_setopt($ch, CURLOPT_URL, $url);                     // Заходим на сайт
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          // Приказываем вернуть страницу в переменную

$html = curl_exec($ch);                                  // Забираем страницу

curl_setopt($ch, CURLOPT_URL, $urlTo);              // Куда шлем POST данные
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');          // Приказываем вернуть страницу в переменную
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          // Приказываем вернуть страницу в переменную
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  // Записываем cookie
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt'); // Читаем cookies
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POST, true); // Указываем что будем отправлять POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Отправляем POST
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);     // Говорим скрипту, чтобы он следовал за редиректами которые происходят во время авторизации


echo $html = curl_exec($ch); // Забираем страницу
curl_close($ch);        // Завершаем сеанс
echo $html;             // Оказываемся в вашем ящике?>
 
*/
?>
</head>
<body>
 
 
</body>
</html>