<!--АВТОРИЗАЦИЯ-->
<div id="modal_window">
  <form class="form-container" action="" method="post" name="auth" id="authorization">
    <div class="form-title"><h2>Авторизация</h2></div>
    <div class="form-title">Логин</div>
    <input class="form-field" name="login" type="text" id="auth_login" placeholder="введите логин"><br >
    <div class="form-title">Пароль</div>
    <input class="form-field" name="pass" type="password" id="auth_pass" placeholder="введите пароль"><br >
    <div style="color: red; display: none" id="errors"></div>
    <br>
    <div class="form-remember">
      <label for="check">Запомнить:</label>
      <div class="check"><input name="autoauth" type="checkbox" id="auth_check"></div>
      <br>
      <br>
    </div>
    <div class="submit-container">
      <input class="submit-button" type="submit" name="submit" id="submit" value="Вход">
    </div>
  </form>
</div> <!-- /#modal_window -->

