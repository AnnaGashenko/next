<?php
// Убиваем сесию и куки

setcookie('auto_autoauth_hash', $_SESSION['user']['hash'], time()-3600*24*30*12,'/');
setcookie('auto_autoauth_id', $_SESSION['user']['id'], time()-3600*24*30*12,'/');
session_unset();
session_destroy();

//делаем переадресацию на главную
header("Location: /");
exit();

