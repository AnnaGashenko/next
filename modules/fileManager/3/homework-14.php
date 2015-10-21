<?php


/////////////////////////////////////////////////////////  
/** 
* We establish the charset and level of errors 
* Устанавливаем кодировку и уровень ошибок 
*/ 

	error_reporting(-1);  
    header("Content-Type: text/html; charset=utf-8");


/////////////////////////////////////////////////////////////// 
//                   FUNCTION CALCULATOR
//                   ФУНКЦИЯ КАЛЬКУЛЯТОР 
///////////////////////////////////////////////////////////////// 


	function calculator($num1, $num2, $action){	
	
        $sum = 0;
                                            
        if($action == '+'){ 
        	$sum = $num1 + $num2;	
        }

        elseif($action == '-'){ 
        	$sum = $num1 - $num2;	
        }

        elseif($action == '*'){ 
        	$sum = $num1 * $num2;	
        }

        elseif($action == ':'){ 
        	$sum = $num1 / $num2;	
        }
        return $sum;
	}


///////////////////////////////////////////////////////////////// 
//                        SCRIPT 
//                        СКРИПТ 
/////////////////////////////////////////////////////////////////


    if(isset($_POST['submit'],$_POST['num1'],$_POST['num2'])) {  
	
		if(!isset($_POST['action'])) {
			$_POST['action'] = '+';
	    }
        if($_POST['num1'] == '') {
            echo 'Вы не ввели первое число.';
		}
        if($_POST['num2'] == '') {
            echo 'Вы не ввели второе число.';  
		}
        if($_POST['num2'] == 0 && $_POST['action'] == ':'){
            echo 'На ноль делить нельзя!';  
		}
		else{
			echo '<p style="background-color:#FC6"> РЕЗУЛЬТАТ: '
				. $_POST['num1'].' '
				. $_POST['action'].' '
				. $_POST['num2'].' = '
				. calculator($_POST['num1'], $_POST['num2'], $_POST['action'])
				. '</p>';
		}
    }  
    else   
        echo 'Заполните форму';  

    echo '<br>POST:<pre>'.print_r($_POST,1).'</pre>';

 		
		
///////////////////////////////////////////////////////////////// 
//                        VIEW 
//                    ОТОБРАЖЕНИЕ 
/////////////////////////////////////////////////////////////////

?>		
	
	<form action="" method="post">
	
	Введите первое число: <br>
	<input name="num1" type="text"><br>
    
	Введите второе число: <br>
	<input name="num2" type="text"><br>
	
	Выбирите действие: <br>
	<label>плюс<input name="action" type="radio" value="+"></label><br>
	<label>минус<input name="action" type="radio" value="-"></label><br>
	<label>умножить<input name="action" type="radio" value="*"></label><br>
	<label>делить<input name="action" type="radio" value=":"></label><br>
	
	<input name="submit" type="submit" value="отправить" />
	
	</form>


