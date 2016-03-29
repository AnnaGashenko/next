<div>

  <!--Если пользователь не зарегестрировался выводим форму-->
  <?php if(!isset($_SESSION['regok'])){  ?>

<div class="registration_window">
  <form class="form-container" action="" method="post">
    <div class="form-title"><h2>Регистрация</h2></div>

    <div class="form-title">Логин *</div>
    <input class="form-field" name="login" type="text" placeholder="введите логин" value="<?php echo @htmlspecialchars($_POST['login']); ?>">
    <div class="error_reg"><?php echo @$errors['login']; ?></div>
    <br >

    <div class="form-title">Пароль *</div>
    <input class="form-field" name="password" type="password" placeholder="введите пароль"><br >
    <div class="error_reg"><?php echo @$errors['password']; ?></div>
    <br>

    <div class="form-title">E-mail *</div>
    <input class="form-field" name="email" type="email" placeholder="введите email" value="<?php echo @htmlspecialchars($_POST['email']); ?>">
    <div class="error_reg"><?php echo @$errors['email']; ?></div>
    <br >

    <div class="submit-container">
      <input class="submit-button" type="submit" name="sendreg"" id="submit" value="Зарегистроваться">
    </div>
  </form>
</div>

  <!--Иначе, если пользователь  зарегестрировался выводим сообщение и делаем переадресацию-->
  <!--Удаляем сесию после переадресации и снова выводится форма-->
  <?php } else {unset($_SESSION['regok']); ?>
    <div class="info">Для активации вашей учетной записи, пройдите по ссылке в письме, которое мы отправили на ваш почтовый ящик</div>
  <?php } ?>
</div>