<?php if(isset($_COOKIE['access']) || $_SERVER['REMOTE_ADDR'] == '93.73.125.92') { ?>
  <ul>
    <li><a href="index.php?module=authorization&page=admin_auth">АДМИНКА</a></li>
    <li><a href="index.php?module=authorization&page=exit_auth">ВЫХОД</a></li>
  </ul>
<?php } else {  ?>
<!--    <form action="" method="post" name="auth">
      <span style="font-weight:bold">Введите логин:</span> <br>
      <input name="login" type="text"><br><br>
      <span style="font-weight:bold">Введите пароль:</span> <br>
      <input name="pass" type="password"><br><br>
      <span style="font-weight:bold">Введите email:</span> <br>
      <input name="email" type="text"><br><br>      
      <input name="submit_auth" type="submit"><br>
    </form>
-->  
  
  <form class="form-container" action="" method="post" name="auth">
<div class="form-title"><h2>Авторизация</h2></div>
<div class="form-title">Логин</div>
<input class="form-field" name="login" type="text"><br >
<div class="form-title">Пароль</div>
<input class="form-field" name="pass" type="text"><br >
<div class="form-title">Email</div>
<input class="form-field" type="text" name="email" /><br>
<div class="submit-container">
<input class="submit-button" type="submit" name="submit_auth" value="Отправить" />
</div>
</form>
  
  
<?php 
	echo @$login; //сокращено от того, что ниже
	if(isset($pass)) {
		echo $pass;
	}
	if(isset($false_email)) {
		echo $false_email;
	}
} // закрывает else

?>
