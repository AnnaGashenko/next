<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
setcookie('access', '1', time()-3600,'/');
header("Location: /index.php?module=authorization&page=auth");
exit();
?>