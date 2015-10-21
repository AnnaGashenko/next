<?php
// Калькулятор контроллер
$result = '';
if(isset($_POST['num1'],$_POST['num2'],$_POST['action'])) {
	if($_POST['action'] == 'plus') {
		$result = $_POST['num1'] + $_POST['num2'];
		$_SESSION['res'] = $result;
	}
}