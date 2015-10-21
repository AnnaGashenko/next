<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>


// например чтобы не выводить все сообщения в чате, а только последние добавленные
// создаем сессию в которую звписывем последнее обращение к серверу
// время последнего запроса
<?php 
$_SESSION[''] = time();
?>
// запрашиваем комментарии которые были добавлены после этого time()
-- Просим новые комментарии 
где time на сервере (БД) чем time когда мы в последний раз запрашивали комментарии
$_SESSION['time'] > time...;

--- Получили комментарии, обработали в цикле и вывели на экран
<?php while(){echo} ?>
- после вывода создали новый этап времени
<?php $_SESSION[''] = time(); ?>

<script>

// Например нам нужно один текст вывести вверху страницы, другой слева и т.д.

///// test.php /////

function myAjax() {
	// получим текст из дива "ххх"
	x = document.getElementById('xxx').innerHTML;
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		timeout: 5000, // 5 сек
		data: {logni: 'inpost', age : 24, text : x},
		// если результат положительный
		success: function(msg) {
			// получить данные из массива в виде объекта
			alert(msg);
		},
	});
}
</script>
<?php

///// test_ajax.php /////
// Этот массив мы передаем в JS 

$array = array(
	'name' => 'Александр',
	'surname' => 'Радионов',
	'nick' => 'Yamamoto'
);

// массив перекодируем в строку {"name":"Александр","surname":"Радионов","nick":"Yamamoto"}
// возвращаем результат в виде объекта
echo json_encode($array);

/*
json_encode — Возвращает JSON-представление данных
Возвращает JSON закодированную строку (string) в случае успеха или FALSE в случае возникновения ошибки.

Пример #1 Пример использования json_encode()

<?php
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

echo json_encode($arr);
?>
Результат выполнения данного примера:

{"a":1,"b":2,"c":3,"d":4,"e":5}
*/
?>
<script>

// И дальше снова перекодируем в массив (объект) -> var response = JSON.parse(msg);

///// test.php /////

function myAjax() {
	// получим текст из дива "ххх"
	$.ajax({
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		data: {login: 'inpost'},
		// если результат положительный
		success: function(msg) {
			var response = JSON.parse(msg);
			// выводим элементы .name, .surname объекта response
			alert(response.name + ',' + response.surname);
		},
	});
}

// как выглядит response
response = 	{
	'name' => 'Александр',
	'surname' => 'Радионов',
	'nick' => 'Yamamoto'
}
</script>


<?php  

///// test_ajax.php /////
// записываем статус
$array['status'] = 'ok';

// Если новых сообщений нет
$array['status'] = 'empty';
?>

<script>

// И дальше снова перекодируем в массив (объект) -> var response = JSON.parse(msg);

///// test.php /////

function myAjax() {
	// получим текст из дива "ххх"
	$.ajax({
		// то куда мы отправляем данные
		url: '/test_ajax.php',
		type: "POST",
		cache: false,
		// отправляем переменные
		data: {login: 'inpost'},
		// если результат положительный
		success: function(msg) {
			var response = JSON.parse(msg); // работает везде кроме IE7
			// для IE7
			// var response = eval(" (" + msg + ") ");
			// проверяем, если статус "ок" значит пришли новые сообщеения - выводим данные - обрабатываем код
			// если $array['status'] = 'empty'; - то этой части кода обрабатываться нет смысла
			if(response.status == 'ok') {
				alert(response.name + ',' + response.surname);
			}
		},
	});
}

////////////////////////////
///////// JQuery //////////
//////////////////////////

window.onload = function() {
	// при клике на этот див вызывается функция myJquery
	document.getElementById('yyy').onclick = myJquery;
}

function myJquery() {
	$('#yyy').attr('data-color'); // получаем значение атрибута (green)
	$('#yyy').attr('data-color','red'); // меняем значение атрибута (с green на red)}
	$('#yyy').css('background-color','red'); // меняем/устонавливаем цвет
	$(this).css('color','red'); // $(this) - тот элемент по которому был сделан клик
	
	// возвращает сколько сейчас времени в миллисекундах
	// нужно чтобы узнать сколько времени прошло между первым и вторым запросом
	nowtime = new Date().getTime();
}	
	
</script>

<div id="yyy" style="color:#00C" data-color="green">Тестируем jQuery</div>


















</body>
</html>