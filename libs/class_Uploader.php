<?php
class Uploader {
	
	static $types = array('image/gif','image/jpeg','image/png');
	static $array2 = array('jpg','jpeg','png','gif');
	static $error;
	static $size;
	static $name;
	static $path;
	
	static function upload($file, $path) {
			if($file['error'] == 0){
				if ($file['size'] < 2000 || $file['size'] > 5000000){
					self::$error = 'Размер изображения нам не подходит';
				} else {
					preg_match('#\.([a-z]+)$#iu',$file['name'],$matches);
					if(isset($matches[1])) {
						// Если пользователь загрузит файл с расширение в верхнем регистре JPEG
						// Делаем его в нижнем регистре с помощью mb_strtolower
						$matches[1] = mb_strtolower($matches[1]);
						// getimagesize - получаем инфо о файле				
						self::$size = getimagesize($file['tmp_name']);
						// Создаем имя файла
						self::$name = date('Ymd-His').'img'.rand(10000,99999).'.'.$matches[1];
						// Полный путь к файлу
						self::$path = $path;
						$path_directory = './uploaded/'.self::$path.'/original/'.self::$name;
						
						if(!in_array($matches[1],self::$array2)){ // проверяем совпадения массивов
							self::$error = 'Не подходит расширение изображения';	
						// in_array - возвращает true, если элемент со значением $size['mime'] присутствует в массиве $array;
						} elseif(!in_array(self::$size['mime'],self::$types)){
							self::$error = 'Не подходит тип файла, можно загружать только изображения';	
						// функцией move_uploaded_file() мы перемещаем файл в выбранную нами директорию из его временного хранилища.
						} elseif(!move_uploaded_file($file['tmp_name'], $path_directory)){
							self::$error = 'Изображение не загружено! Ошибка';
						} else {
							return $path_directory;
						}
					} else {
						self::$error = 'Данный файл не является картинкой';	
					}
				}
			}
	}
	static function resize($loaded_file,$w,$h) {
		//Берём числовое значение ширины фотографии и записываем это число в переменную
		$iw=self::$size[0];
		//Проделываем ту же операцию, что и в предыдущей строке, но только уже с высотой.
		$ih=self::$size[1];
		// Проверяем если ширина или высота больше 100
		if ($iw > $w || $ih > $h){
			// если ширина больше высоты 
			if($iw >= $ih) {
				//Ширину фотографии делим на 100 т.к. на выходе мы хотим получить фото шириной в 100 пикселей. В результате получаем коэфициент соотношения ширины оригинала с будущей превьюшкой.
				$new_w=$w;
				$koe = $iw/$new_w;
				//Делим высоту изображения на коэфициент, полученный в предыдущей строке, и округляем число до целого в большую сторону — в результате получаем высоту нового изображения.
				$new_h=ceil ($ih/$koe);
			// если высота больше ширины
			} elseif($iw < $ih) {
				$new_h = $h;
				$koe=$ih/$new_h;
				$new_w=ceil ($iw/$koe);
			}
			$tmp=imagecreatetruecolor($new_w, $new_h);
			
			//Создаём новое изображение из «старого»
			if (self::$size['mime'] == 'image/jpeg') {
				$src = imagecreatefromjpeg($loaded_file);
			} elseif (self::$size['mime'] == 'image/png') {
				$src = imagecreatefrompng($loaded_file);
				imagealphablending($tmp, false);
				imagesavealpha($tmp, true);
			} elseif (self::$size['mime'] == 'image/gif') {
				$src = imagecreatefromgif($loaded_file);
				$transparent_source_index=imagecolortransparent($src);
				//Проверяем наличие прозрачности
				if($transparent_source_index!= -1) {
					$transparent_color=imagecolorsforindex($src, $transparent_source_index);	
					
					//Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
					$transparent_destination_index=imagecolorallocate($tmp, $transparent_color['black'], $transparent_color['green'], $transparent_color['blue']);
					imagecolortransparent($tmp, $transparent_destination_index);
		 
					//На всякий случай заливаем фон этим цветом
					imagefill($tmp, 0, 0, $transparent_destination_index);
				}
			}
			
			

			
/*		//Создаём пустое изображение шириной и высотой, которую мы вычислили в предыдущей строке.
		$tmp=imagecreatetruecolor($new_w, $new_h);
*/			
/**
 Перед тем как произодить опрерации с новым ресурсом,
 установим некоторые опции
 imageAlphaBlending - устанавливает режим смешивания(режим
 смешивания недоступен для изображений с палитрой)
 по умолчанию для truecolor изображений - true, для изображений
 с палитрой - false
 true/false - включен/выключен
 
        true - при накладывании одного изображения на другое
        цвета пикселей нижележащего и накладываемого изображения смешиваются,
        параметры смешивания определяются прозрачностью пикселя.
 
        false - накладываемый пиксель заменяет исходный
			imagealphablending($tmp, false);			

ImageSaveAlpha
Сохранять или не сохранять информацию о прозрачности
по умолчанию - false, а надо true
		
			imagesavealpha($tmp, true);
			// ДЛЯ GIF
			//Получаем прозрачный цвет
			$transparent_source_index=imagecolortransparent($src);
			//Проверяем наличие прозрачности
			if($transparent_source_index!= -1) {
				$transparent_color=imagecolorsforindex($src, $transparent_source_index);	
				
				//Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
				$transparent_destination_index=imagecolorallocate($tmp, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
				imagecolortransparent($tmp, $transparent_destination_index);
	 
				//На всякий случай заливаем фон этим цветом
				imagefill($tmp, 0, 0, $transparent_destination_index);
            }
*/					
			//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
			imagecopyresampled ($tmp, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);

			// записываем путь к файлу
			$filename = '/uploaded/'.self::$path.'/'.$w.'x'.$h.'/' .self::$name;

			//Сохраняем полученное изображение в файл в нужном формате
			if (self::$size['mime'] == 'image/jpeg') {
				imagejpeg($tmp, '.'.$filename, 100);
			} elseif (self::$size['mime'] == 'image/png') {
				imagepng($tmp, '.'.$filename);
			} elseif (self::$size['mime'] == 'image/gif') {
				imagegif($tmp, '.'.$filename);
			} else {
				return false;
			}
			return $filename;
			
			// Освобождаем память
			imagedestroy($src);
			imagedestroy($tmp);
		}
	}	
}

/*	
if($temp = Uploader::Upload($_FILES['file'])) {
    $avatar['big'] = Uploader::Resize($temp,100,100);
    $avatar['small'] = Uploader::Resize($temp,150,150);
} else {
    echo $error['file'] = Uploader::$error;
}



// Если нет ошибок
if(!count($error['file'])) {
	// добавляем в БД запись и ссылки на фотографии.
	q("
		UPDATE `users` SET
		`img`        = '".stringAll($tmp_path .'small_'.$name)."'
		WHERE `id`   = ".(int)$_SESSION['user']['id']."
	"); 
	
}

*/