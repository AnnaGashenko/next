<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>JS lesson 36</title>
<script type="text/javascript" src="/skins/default/js/scripts_v1.js"></script>
</head>

<body>
<script>
function hide() {
	$i = 0;
	// при каждом втором вызове - вызывается ф-я show
	if(++$i % 2 == 0) {// остаток от деления = 0
		show();
	}
	document.getElementById('xxx').style.display = 'none';
}
// чтобы скрипт выполнялся после загрузки всей html страницы
window.onload = function() {
	internalId = setInterval(hide,2000);	
}
</script>

_________________________________________________________________

                                           МАССИВЫ PHP
                                           
<?php
$users = array(
	'user1' => array(
		'name' => 'Стас',
		'Nick' => 'inpost',
		'age' => 26,
		'skilllevel' => 100,
	),
	'user2' => array(
		'name' => 'Михаил',
		'Nick' => 'Myrzzz',
		'age' => 13,
		'skilllevel' => 1,
	),
	'user3' => array(
		'name' => 'Александр',
		'Nick' => 'Пистолетов',
		'age' => 32,
		'skilllevel' => 100500,
	),
);

// Получаем данные из массива
foreach($users as $k => $v) {
	echo $v['Nick']. '(' .$v['age']. ')<br>';	
}

inpost(26)
Myrzzz(13)
Пистолетов(32)

$users->Nick; // Вызов объекта
$users['Nick']; // Вызов ассоциатвного массива

?>

                                          МАССИВЫ JS

<script>
var users = {'key1' : 'value1', 'key2' : 'value2'};
alert(users['key2']); // выведит value2
------------------------------------------------------
var users = {'name' : 'Stas', 'age' : 25};
alert(users['name']); // выведит Stas
// т.к. это объект, лаконичнее (правильнее) будет
alert(users.name); // выведит Stas

alert(users['name']); // Вызов объекта
alert(users.name); // Вызов объекта

В JS мы работаем с объектами, хотя теоритечески это все те же самые массивы


var users = {
	'user1' : {
		'name' :'Стас',
		'Nick' : 'inpost',
		'age' : 26,
		'skilllevel' : 100,
	},
};

alert('Пользователь:' + users.user1.name + ' Возраст:' + users['user1']['age']);


// Перебираем объект, как в php -> foreach перебирали массив

for(key in users.user1) {
	console.log(users.user1[key]);
}

// Например в чате вывести все сообщения
var users = {
	'user1' : {
		'name' :'Стас',
		'Nick' : 'inpost',
		'age' : 26,
		'skilllevel' : 100,
	},
	'user2' : {
		'name' : 'Михаил',
		'Nick' : 'Myrzzz',
		'age' : 13,
		'skilllevel' : 1,
	},
	'user3' : {
		'name' : 'Александр',
		'Nick' : 'Пистолетов',
		'age' : 32,
		'skilllevel' : 100500,
	},
};

for(key in users) {
	console.log(users[key].Nick + ':' +users[key].age + ', ' +users[key].skilllevel);
}

</script>
</body>
</html>
