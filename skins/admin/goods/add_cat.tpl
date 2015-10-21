<div class="news">    
  <h1>Новая категория</h1>
  <form action="" method="post">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title" width="200">Название категории*</td>
		<!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value--> 
       <td><input name="name" type="text" value="<?php echo @htmlspecialchars($_POST['name']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['name']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Краткое описание*</td>
        <td><textarea name="description"><?php echo @htmlspecialchars($_POST['description']); ?></textarea></td>
        <td><span class="news_error"><?php echo @$errors['description']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Описание*</td>
        <td><textarea name="text"><?php echo @htmlspecialchars($_POST['text']); ?></textarea></td>
        <td><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        <td><input name="add" type="submit" value="Добавить категорию"></td>
      </tr>
    </table>
  </form>
</div>



