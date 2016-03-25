<?php


class UnicumCode {
    protected $cod;

	public function __construct() {
		$this->cod = uniqid();
		$this->cod = md5(uniqid(rand(),1));
		$this->cod = substr($this->cod,-10);
	}
}


class ChangeToNumbers extends UnicumCode {

	public function createNumber() {
		preg_match_all('#[a-z]#ui',$this->cod,$matches);
		$replacements = range(0,9);
		shuffle($replacements);
		$result = str_replace($matches[0], $replacements, $this->cod);
		return $result;
	}
}


class ChangeToAbc extends UnicumCode {

	public function createLetters() {
		preg_match_all('#\d#ui',$this->cod,$matches);
		$replacements = range('a','z');
		shuffle($replacements);
		$result = str_replace($matches[0], $replacements, $this->cod);
		return $result;
	}
}

class ChangeLatinToCyrillic extends UnicumCode {

	public function createCyrillic() {
		preg_match_all('#[a-z]#ui',$this->cod,$matches);
		$replacements = array("a","б","в","г","д","е","ж","з","и","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","э","ю","я");
		shuffle($replacements);
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