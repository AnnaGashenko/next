<div class="users">    
  <div class="title">Информация о пользователе</div>
  <form autocomplete="off" action="" method="post">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="title_name" width="100">Логин</td>
        <td>
          <input class="input" name="login" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['login']) : htmlAll($row['login']); ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['login']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Пароль</td>
        <!--Сценарию, в числе других параметров приходит пара имя_флажка=значение-->
        <!--Если флажок не был установлен, то пара не посылается-->
        <!--Воспользуемся скрытым полем hidden со значение равным 0-->
        <!-- Помещаем его перед нужным флажком -->
        <!-- Если пользователь не выберет никакой из флажков, браузер отправит сценарию пару active=0 -->
        <!-- Если пользователь выберит флажок, эта пара тоже будет послана-->
        <!-- Но сразу после нее последует пара active=1, которая "перекроет" предыдущее значение  -->
        <td>
          <input class="input" name="password" type="password" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['password']) : ''; ?>">
        </td>
		<td><span class="news_error"><?php echo @$errors['password']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Доступ</td>
        <td>
            <?php foreach($active as $k => $v){  
                    echo '<label><input type="radio" name="active"'.(((isset($_POST['edit']) && $_POST['active'] == $k) || (!isset($_POST['edit']) && $row['active'] == $k)) ? 'checked="checked"' : '').' value="'.$k.'">'.$v.'</label>';
                } 
			 ?>
			<input type="hidden" name="access" value="0"> 
			<?php echo '<label><input type="checkbox" name="access"'.(((isset($_POST['edit']) && $_POST['access'] == 5) || (!isset($_POST['edit']) && $row['access'] == 5)) ? 'checked="checked"' : '').' value="5">Админ</label>'; 
            ?> 
        </td>
      </tr>
      <tr>
        <td class="title_name">Email</td>
        <td>
          <input class="input" name="email" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['email']) : htmlAll($row['email']); ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['email']; ?></span></td>
      </tr>
      <tr>
        <td class="title_name">Создан</td>
        <td><?php echo htmlspecialchars($row['date_registration']);?></td>
      </tr>
      <tr>
        <td class="title_name">Последняя активность</td>
        <td><?php echo htmlspecialchars($row['date_active']);?></td>
      </tr>
      <tr>
        <td class="title_name">IP</td>
        <td><?php echo stringAll($row['ip']);?></td>
      </tr>
    </table>
    <div class="button">
      <div class="users_edit"><input name="edit" type="submit" value="Отредактировать"></div>
      <div class="users_del"><input name="del" type="submit" value="Удалить"></div>
    </div>
    <div class="clear"></div>

  </form>
</div>