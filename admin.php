<?php
	if($_SERVER['REMOTE_ADDR'] != '93.73.125.92'){
		exit('Вы не админ');
	}
	else{echo'Добро пожаловать админ';}
?>