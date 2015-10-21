<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Проверка логина и пароля</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function() {

	$("#auth form").submit(function(eventObject){
		// Получаем занчение полей логин и пароль
		var login = $("#auth form #login").val();
		var pass = $("#auth form #pass").val();
		if($('#auth form #check').is(':checked')) {
			var check = ($(this).attr('name'));
		} 
		// Если поля логин или пароль не заполнены
		if(login == '' || pass == '') {
			if(login == "") {
			  eventObject.preventDefault();
			  $("#auth form #login").css('border','1px solid #F00');
			} else {
			  $("#auth form #login").css('border','1px solid green');
			}
			if (pass == "") {
			  eventObject.preventDefault();
			  $("#auth form #pass").css('border','1px solid #F00');
			} else {
			  $("#auth form #pass").css('border','1px solid green');
			}
		// если все в порядке отправляем запрос на сервер
		} else {
			eventObject.preventDefault();
			$.ajax({
				url: 'test_ajax.php',
				type: "POST",
				cache: false,
				// какие данные мы передаем на сервер
				data: {
					login: login,
					pass: pass,
					check: check
				},
				success: function(msg) {
					alert(msg);
				}
			});
		}
	});	
	
});// конец ready
</script>
 </head >

 <body >

<!--АВТОРИЗАЦИЯ-->

<div id="auth" style="padding:100px">
<?php if(!isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'] )) { 
   if(!isset($status) || $status != 'OK')  { echo @$error;   ?>
     <form class="form-container" action="" method="post" name="auth" id="authorization">
        <div class="form-title"><h2>Авторизация</h2></div>
        <div class="form-title">Логин</div>
        <input class="form-field" name="login" type="text" id="login" placeholder="введите логин"><br >
        <div class="form-title">Пароль</div>
        <input class="form-field" name="pass" type="password" id="pass" placeholder="введите пароль"><br >
		<div style="color: red; display: none" id="errors"></div><br>
          <div class="form-remember">
            <label for="check">Запомнить:</label>
            <div class="check"><input name="autoauth" type="checkbox" id="check"></div>
            <br>
            <br>
          </div>
        <div class="submit-container">
        <input class="submit-button" type="submit" name="submit" id="submit" value="Вход">
        </div>
     </form>
  <?php } else {  ?>
  	<div id="auth_ok">Поздравляю, вы авторизированы</div>
  <?php } }?>
</div>


 </body>
</html>
