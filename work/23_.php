<?php
//Добавляем функция в default.php

function q($query) {  //mysqli_query
//  Достаем $link из глобального массива, чтобы она была видна внутри функции(все переменные дублируются $GLOBALS)
//	$link = $GLOBALS['link'];
//  Либо так (тот же эффект)
    global $link;
	$res = mysqli_query($link, $query);
	if($res === false) {
		$info = debug_backtrace();
		wtf(info);
		$error = "QUERY: ".query."<br>\n".mysqli_error($link);
		// Отправку уведомления на почту
		// Логировать ошибки (записывать их в файл)
		file_put_contents('./log/mysql.log',strip_tags($query)."\n\n",FILE_APPEND);
		echo $error;
		// file_put_contents() - записывает инфо в файл -> Создает файл по указанному пути './log/mysql.log'
		// FILE_APPEND - флаг. Еслм использовать функцию без этого параметра, то файл перезапишется. А так данные будут добавляться в конец файла
		// "\n\n" - означает, что каждая новая запись будет начинаться с новой строчки. Это важно!
		exit();
	}else{
		return $res;
	}
}

$res = q($link,"
	SELECT * 
	FROM `users`
	WHERE `id` = '1'1'
	ORDER BY `id`
");
