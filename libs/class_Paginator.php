<?php
class Paginator {
	// Создаем дефолтные значения (по умолчанию)
	// показать 5 страниц
	static $show_pages = 5;
	// Переменная хранит число сообщений выводимых на станице из БД
	static $num = 5; 
	//  количество страниц
    static $total;	
	// текущая активная страница
	static $page_num;
	// первая видимая страница
	static $start;
	// последняя видимая страница
	static $end;
	static $result;
	// подключаемый модуль
	static $module;
	static $cat;
	static $page;
	static $shift;
	
	static function __($page_num,$page,$module,$res) {
		self::$page_num = $page_num;
		self::$page = $page;
		self::$module = $module;

		// Переменная хранит число сообщений выводимых на станице 
		$row = $res->fetch_row();
		$count = $row[0];
		
		// разбиваем постранично
		// узнаем сколько страниц получается
		// округляем в большую сторону
		self::$total = ceil($count/self::$num);
	
	// если количество страниц больше 1
		if (self::$total > 1) { 
			$left = $page_num - 1;
			$right = self::$total - $page_num;
			if ($left < floor(self::$show_pages / 2)) {
				self::$start = 1;
			} else { 
				self::$start = $page_num - floor(self::$show_pages / 2);
			}
			self::$end = self::$start + self::$show_pages - 1;
			
			if (self::$end > self::$total) {
				self::$start = self::$start - (self::$end - self::$total);
				self::$end = self::$total;
				if (self::$start < 1) self::$start = 1;
			}
		}	
		
		self::$shift = ($page_num * self::$num) - self::$num;		
	}
	
	static function showPaginator($cat = false) {	
	    self::$cat = $cat;
		if(self::$total > 1) {
			$menu = '';  
			for($i = self::$start; $i <= self::$end; $i++) {
				if (self::$page_num == $i) {
					$class = 'green';	
				} else {
					$class = 'grey';	
				}
				if($cat != false) {	
					$menu .= ' <a class="'.$class.'" href="/'.self::$module.'/'.self::$page.'?cat='.self::$cat.'&page_num='. $i .'">'. $i .'</a>  ';   
				} else {
					$menu .= ' <a class="'.$class.'" href="/'.self::$module.'/'.self::$page.'?page_num='. $i .'">'. $i .'</a>  ';  
				}
			}
			
			// если текущая страница не 1, выводим кнопку Предыдущая
			if(self::$page_num > 1) {
				if($cat != false) {	
					echo $back = "<a class='grey' href='/".self::$module."/".self::$page."?cat=".self::$cat."&page_num=" .(self::$page_num -1). "'>&lt;&lt; </a>";
				} else {
					echo $back = "<a class='grey' href='/".self::$module."/".self::$page."?page_num=" .(self::$page_num -1). "'>&lt;&lt; </a>";
				}
			}

			// Выводим первую страницу и кнопку ...
			if(self::$start != 1) {
				// Если это категория
				if($cat != false) {	
					echo "<a class='grey' href='/".self::$module."/".self::$page."?cat=".self::$cat."&page_num=1'>1</a>";
				} else {
					echo "<a class='grey' href='/".self::$module."/".self::$page."?page_num=1'>1</a>";
				}
				echo "<a class='grey'>...</a>";
			}

			echo $menu;
			// если текущая страница не последняя, выводим кнопку следущая
			if (self::$page_num != self::$total) {
				// если текущая страница не последняя и  выводим номер последней страницы и кнопку ...
				if (self::$end != self::$total) {
					echo "<a class='grey'>...</a>";
					if($cat != false) {	
						echo "<a class='grey' href='/".self::$module."/".self::$page."?cat=".self::$cat."&page_num=" .(self::$total). "'>".self::$total."</a>";
					} else {
						echo "<a class='grey' href='/".self::$module."/".self::$page."?page_num=" .(self::$total). "'>".self::$total."</a>";
					}
				}
				if($cat != false) {	
					echo "<a class='grey' href='/".self::$module."/".self::$page."?cat=".self::$cat."&page_num=" .(self::$page_num +1). "'> &gt;&gt;</a>";
				} else {
					echo "<a class='grey' href='/".self::$module."/".self::$page."?page_num=" .(self::$page_num +1). "'>&gt;&gt;</a>";	
				}
			}
		} 
	}
	
}

