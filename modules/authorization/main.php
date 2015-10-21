<?php
 error_reporting(-1);
 ini_set('display_errors',1);
 header('Content-Type: text/html; charset=utf-8');
 

    if(isset($_POST['submit_auth'], $_POST['login'], $_POST['pass'], $_POST['email'])) { 
	 
        if($_POST['login'] == '') {
 			$login = '<p style="background-color:#FC6">Вы не ввели логин </p><br>';
		}
		
        elseif($_POST['pass'] == '') {
			$pass = '<p style="background-color:#FC6"> Вы не ввели пароль </p><br>';
		}
    
		elseif($_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){   
 			$false_email = '<p style="background-color:#FC6"> e-mail введен не верно </p><br>';
        }

		else{
			setcookie('access', '1', time()+3600,'/');
			header("Location: index.php?module=authorization&page=main");  
			exit();          
		}
		
	}
?>

