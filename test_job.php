<?php

class UnicumCode {
    protected $cod;

	public function __construct() {
		// Эта функция возвращает уникальный идентификатор, основываясь на значениях текущего времени в микросекундах
		// обрабатываем md5 При таком варианте использования функции возвращается 128-битный хеш-код
		$this->cod = md5(uniqid(rand(),1));
		// возращает последние 10 символов
		$this->cod = substr($this->cod,-10);
	}
}


class ChangeToNumbers extends UnicumCode {

	public function createNumber() {
		// находим все латинские буквы
		preg_match_all('#[a-z]#ui',$this->cod,$matches);
		// Создает массив, содержащий диапазон элементов от 0 до 9
		$replacements = range(0,9);
		// shuffle — Перемешивает массив
		shuffle($replacements);
		// заменяем найденные символы на цифры
		$result = str_replace($matches[0], $replacements, $this->cod);
		return $result;
	}
}


class ChangeToAbc extends UnicumCode {

	public function createLetters() {
		// находим все цифры
		preg_match_all('#\d#ui',$this->cod,$matches);
		// Создает массив, содержащий диапазон элементов от a до z
		$replacements = range('a','z');
		// shuffle — Перемешивает массив
		shuffle($replacements);
		// заменяем найденные цифры на буквы латинского алфавита
		$result = str_replace($matches[0], $replacements, $this->cod);
		return $result;
	}
}

class ChangeLatinToCyrillic extends UnicumCode {

	public function createCyrillic() {
		// находим все латинские буквы
		preg_match_all('#[a-z]#ui',$this->cod,$matches);
		// Создает массив, содержащий буквы кириллического алфавита
		$replacements = array("a","б","в","г","д","е","ж","з","и","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","э","ю","я");
		// shuffle — Перемешивает массив
		shuffle($replacements);
		// заменяем найденные буквы латинского алфавита на буквы кириллического алфавита
		$result = str_replace($matches[0], $replacements, $this->cod);
		return $result;
	}
}


$number = new ChangeToNumbers;
echo 'код состоящий только из цифр: '.$number->createNumber();

echo "<hr>";

$ChangeToAbc = new ChangeToAbc;
echo 'код только из букв латинского алфавита: '.$ChangeToAbc->createLetters();

echo "<hr>";

$Cyrillic = new ChangeLatinToCyrillic;
echo 'код состоящий буквы кириллического алфавита: '.$Cyrillic->createCyrillic();
