<?php if(isset($_COOKIE['access']) || $_SERVER['REMOTE_ADDR'] == '93.73.125.92') { ?>
  <ul>
    <li><a href="index.php?module=authorization&page=admin_auth">АДМИНКА</a></li>
    <li><a href="index.php?module=authorization&page=exit_auth">ВЫХОД</a></li>
  </ul>
<?php } else {  ?>
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
} ?> <!-- / close else --> 


