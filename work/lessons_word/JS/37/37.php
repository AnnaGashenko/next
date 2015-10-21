<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>

<script>
// создаем файл test.php

function myAjax() {
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		// кэш запоминает ответ
		cache: false,
		// какие данные мы передаем на сервер
		data: {key1: 'value', key2 : 'value2'},
		// если результат положительный
		success: function(msg) {
			// выведит Это пришел код со станицы test_ajax.php
			alert(msg);
		},
	});
}

window.onload = function() {
	// при клике на этот див вызывается функция myAjax
	document.getElementById('xxx').onclick = myAjax;
}


</script>
<div id="xxx">Тестируем AJAX</div>


<!-- Создаем файл test_ajax.php-->
<?php echo 'Это пришел код со станицы test_ajax.php'; ?>

<!-- Проверяем, что у нас в data: {key1: 'value', key2 : 'value2'} -->

<?php 
foreach($_POST as $k => $v) {
	echo $k .'='. $v. '<br>';
} 
?>


<script>
// файл test.php

function myAjax() {
	// получим текст из дива "ххх"
	x = document.getElementById('xxx').innerHTML;
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		// добавим timeout - ожидание ответа сервера
		timeout: 15000, // 15 сек
		// передаем текст из переменной "x"
		data: {logni: 'inpost', age : 24, text : x},
		// если результат положительный
		success: function(msg) {
			// выведит Это пришел код со станицы test_ajax.php
			alert(msg);
		},
	});
}

window.onload = function() {
	// при клике на этот див вызывается функция myAjax
	document.getElementById('xxx').onclick = myAjax;
}

//////////////////////////////////////////////////
Все, что мы выводим в файле test_ajax.php
возвращается в переменную msg
	success: function(msg) {
		// здесь мы можем вывести все на экран
		// добавить результат куда-то
		alert(msg);
	}

/////////////////////////////////////////////////////

// добавим timeout - ожидание ответа сервера
timeout: 15000 // 15 сек
-> если за это время ответ  с сервера не пришел, 
-- скрипт останавливается и запрос прерывается

success: function(msg) {
	alert(msg);
}
/////////////////////////////////////////////////////

если ответ не пришел - тогда выдаем ошибку
// свойство error

function myAjax() {
	// получим текст из дива "ххх"
	x = document.getElementById('xxx').innerHTML;
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		// добавим timeout - ожидание ответа сервера
		timeout: 5000, // 5 сек
		// передаем текст из переменной "x"
		data: {logni: 'inpost', age : 24, text : x},
		// если результат положительный
		success: function(msg) {
			// выведит Это пришел код со станицы test_ajax.php
			alert(msg);
		},
		error: function(x, t, m) {
			if(t=="timeout") {
				// можем сами принудительно отправить такой же запрос, через запрос
				// например для чата, отправляем запрос еще раз, чтобы сообщение дошло
				setTimeout(myAjax,10000);
				// alert('Ожидание ответа с сервера слишком велико. Возможно сайт лежит, упал и не работает. Или у вас интернет упал');
				// alert('timeout');
			} else {
				alert('Какие-то проблемы');
				// alert('Message hasn\'t been sent. Error: server doesn\'t answer');
			}
		}
	});
}

///////////////////////////////////////////////

timeout: 15000 и error: нужен в том случае, если что то пошло не так. 

///////////////////////////////////////////////////

проверка timeout
в скрипте test_ajax.php пишем
sleep(10); // на 10 сек

//////////////////////////
////// test_ajax.php  ///
////////////////////////

if(...) {
	echo 'ok';
} else {
	echo 'Ошибка такая то';
}

////// test.php  /////

function myAjax() {
	x = document.getElementById('xxx').innerHTML;
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		timeout: 5000, // 5 сек
		data: {login: 'inpost', age : 24, text : x},
		success: function(msg) {
			// 'ok' - берем из test_ajax.php
			if(msg == 'ok') {
				alert('Ваш комментарий был успешно добавлен');
			} else {
				// сюда выводим например ошибку заполнения поля
				// неправильный логин
				// создаем отведьный див для вывода ошибок
				document.getElementById('test').innerHTML = msg;
				// в "msg" попадает текст из скрипта test_ajax.php
				// echo 'Ошибка такая то';
				// alert(msg);
			}
		},
		error: function(x, t, m) {
			if(t=="timeout") {
				alert('Ожидание ответа с сервера слишком велико. Возможно сайт лежит, упал и не работает. Или у вас интернет упал');
			} else {
				alert('Какие-то проблемы');
			}
		}
	});
}








</script>

</body>
</html>