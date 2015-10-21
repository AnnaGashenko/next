<div>
  <!--Если пользователь не зарегестрировался выводим форму-->
  <?php if(!isset($_SESSION['regok'])){ ?>
  <form action="" method="post">
    <table>
      <tr>
        <td>Логин *</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td><input name="login" type="text" value="<?php echo @htmlspecialchars($_POST['login']); ?>"></td>
        <td><?php echo @$errors['login']; ?></td><!--<?php if(isset($errors['login'])){ echo $errors['login']; }?>-->
      </tr>
      <tr>
        <td>Пароль *</td>
        <td><input name="password" type="password" value="<?php echo @htmlspecialchars($_POST['password']); ?>"></td>
        <td><?php echo @$errors['password']; ?></td>
      </tr>
      <tr>
        <td>E-mail *</td>
        <td><input name="email" type="text" value="<?php echo @htmlspecialchars($_POST['email']); ?>"></td>
        <td><?php echo @$errors['email']; ?></td>
      </tr>
      <tr>
        <td>Возраст</td>
        <td><input name="age" type="text" value="<?php echo @htmlspecialchars($_POST['password']); ?>"></td>
        <td></td>
      </tr>
    </table>
    <p style="font-size:10px">* - обязательные для заполнения</p>
    <input name="sendreg" type="submit" value="Зарегистроваться">
  </form>
  <!--Иначе, если пользователь  зарегестрировался выводим сообщение и делаем переадресацию-->
  <!--Удаляем сесию после переадресации и снова выводится форма-->
  <?php } else {unset($_SESSION['regok']); ?>
  <div class="info">Для активации вашей учетной записи, пройдите по ссылке в письме, которое мы отправили на ваш почтовый ящик</div>
  <?php } ?>
</div>