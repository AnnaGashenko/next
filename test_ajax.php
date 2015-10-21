<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');

foreach($_POST as $k => $v) {
	echo $k .'='. $v. '<br>';
} 




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














