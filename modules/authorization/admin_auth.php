<?php 
if($_SERVER['REMOTE_ADDR'] != '127.0.0.1'){
    $_SESSION['error'] = 'С этого IP доступ закрыт';
	header("Location: /index.php?module=errors");
    exit();
}
?>