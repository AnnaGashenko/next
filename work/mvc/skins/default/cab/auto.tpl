<?php 
if (!isset($status)||$status!="OK"){echo @$error;

?>
    <form method="POST" action="">
        <p>login<input type="text" name="login" value=""></p>
        <p>пароль<input type="password" name="password" value=""></p>
        <input type="checkbox" name="memo" value=1>Запомнить меня
        <p><input type="submit" name="submit" value="Войти на сайт"></p>
        </form>
<?php
}
else {
echo "Вы авторизированы";
    
}