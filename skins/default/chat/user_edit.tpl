<!-- Личный кабинет пользователя -->

<?php if(!isset($_SESSION['editok'])){ ?>
<div class="users">
  <div class="title">Информация о пользователе</div>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="img_file"><img src="<?php echo $_SESSION['user']['avatar_big']; ?>"></div>
      </td>
      <td>
        <form action="" method="post" enctype="multipart/form-data">
          <!--  Поле для ввода имени файла, который пересылается на сервер-->  
          <input type="file" name="file">
      </td>
      <td><div class="error_file"><?php echo @$errors['file']; ?></div></td>
    </tr>
      <tr>
        <td class="title_name" width="100">Логин</td>
        <td>
          <input class="input" name="login" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['login']) : htmlAll($_SESSION['user']['login']); ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['login']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Пароль</td>
        <td>
          <input class="input" name="password" type="password" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['password']) : ''; ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['password']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Email</td>
        <td>
          <input class="input" name="email" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['email']) : htmlAll($_SESSION['user']['email']); ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['email']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Создан</td>
        <td><?php echo htmlspecialchars($_SESSION['user']['date_registration']);?></td>
      </tr>
    </table>
    <div class="button">
      <div class="users_edit"><input name="edit" type="submit" value="Отредактировать"></div>
    </div>
    <div class="clear"></div>
  </form>
</div>

  <?php } else {unset($_SESSION['editok']); ?>
  <h2 class="info">Данные успешно изменены</h2>
  <?php } ?>
  
  

