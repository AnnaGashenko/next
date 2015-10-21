<?php
// Правила создания классов
// Имена класса и название файла должны совпадать
// Файл - class_Mail.php
// Класс - class Mail


/*
// Функция отправки писем
mail ('кому','тема письма','текст письма');
// Помимо этого существует ещё дополнительные параметры
mail ('кому','тема письма','текст письма', $headers (заголовки));
*/

class Mail {
	// Тема письма
	static $subject = 'Вы зарегестрировались на нашем сайте';
	//Отправитель письма
	static $from = 'inpost@list.ru';
	// Получатель
	static $to = 'ann_gash@gmail.com';
	// Текст письма
	static $text = 'Шаблонное письмо';
	static $headers = '';
	
	static function testSend() {
		// Для того чтобы избежать проблемы с кодировкой пишем тему и текст на англ
		if(mail(self::$to,'English words','English words')) {
			echo 'Письмо отправилось';
		} else {
			echo 'Письмо не отправилось';
		}
		exit();
	}
	
	// Функция отправки письма
	static function send() {
		// Чтобы работал русский язык нужно верно указывать кодировку
		self::$subject = '=?utf-8?b'. base64_encode(self::$subject) .'?=';
		self::$headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
		
		// От кого должно совпадать с реальным отправителем, мы может написать отправителя какого угодно
		self::$headers .=  "From: ".self::$from."\r\n";
		//Версия письма
		self::$headers .= "MIME-Version: 1.0\r\n"; 
		//Дата отправки
		self::$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
		//Указывает на то, что письмо является рассылкой
		self::$headers .= "Precedence: bulk\r\n";
		
		/*
		if(mail (self::$to,self::$subject,self::$text,self::$headers)) {
			//echo 'Письмо дошло';
			return true;
		} else {
			//echo 'Письмол не дошло';
			return false;
		}
		*/
		// А можно ещё проще, т.к. сама ф-я mail возвращвет true или false
		return mail (self::$to,self::$subject,self::$text,self::$headers);
	}
}

/*
//Вызываем письмо
// Можем поменять данные отправки - например кому
Mail::$to = 'Oleg@mail.ru';
Mail::$text = 'Наш текст';
// Вызовим ф-ю
Mail::send();

//Можно отправить на ящик который мы указали в ф-и
Mail::testMail();


// Если вдруг пиьмо не дошло:
//1. Проверяем было ли отправлено письмо!
//2. На хостинге отключена отправка писем
//3. Проблемма с отправкой заголовков
//4. Тестировать отправку лучше на gmail  и посмотреть письма в спаме, если в спаме, значит проблемы с кодом!


include './libs/class_Mail.php';
Mail::testSend();

//Есть замечательная ф-я "__autoload" к-я позволяет автоматически подключать классы
// Не нужена прописывать на каждой странице include
// "__autoload" - подгружает класс, если он не был найден
//  В файле default.php
Mail::testSend();
// В $class записывается первое слово (Mail) и дальше в ф-ю автоматически все подставляется
function __autoload($class) {
	include './libs/class_'.$class.'.php';
}
*/