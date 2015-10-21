<?php 
if (!isset($_SESSION['regok'])):?>
    <form action="" method="POST">
       <table id="tb_registration">
          <tr>
             <td colspan="3">
                <p>Данные обязательные для заполнения</p>
                <hr>
             </td>
          </tr>
          <tr>
             <td>Логин</td>
             <td><input type="text" name="login" value="<?php echo @htmlspecialchars($_POST['login'])?>"></td>
             <td><?php echo @$errors['login']; ?></td>
          </tr>
          <tr>
             <td>Пароль</td>
             <td><input type="password" name="password" value="<?php echo @htmlspecialchars($_POST['password'])?>"></td>
             <td><?php echo @$errors['password']; ?></td>
          </tr>
          <tr>
             <td>e-mail</td>
             <td><input type="text" name="email" value="<?php echo @htmlspecialchars($_POST['email'])?>"></td>
             <td><?php echo @$errors['email']; ?></td>
          </tr>
          <tr>
             <td colspan="3"><p>Дополнительные данные</p><hr></td>
          </tr>
          <tr>
             <td>Имя</td>
             <td><input type="text" name="name" value="<?php echo @htmlspecialchars($_POST['name'])?>"></td>
             <td></td>
          </tr>
          <tr>
             <td>Фамилия</td>
             <td><input type="text" name="sername" value="<?php echo @htmlspecialchars($_POST['sername'])?>"></td>
             <td></td>
          </tr>
          <tr>
             <td>Возраст</td>
             <td><input type="text" name="age" value="<?php echo @htmlspecialchars($_POST['age'])?>"></td>
             <td></td>
          </tr>
          <tr>
             <td></td>
             <td><input type="submit" name="submit" value="Регистрация"></td>
             <td></td>
          </tr>
       </table>
   </form>
<?php 
else:
    echo $_SESSION['regok'];
    unset ($_SESSION['regok']);
    echo "<p>Вы успешно зарегистрированы</p>";
endif;
?>