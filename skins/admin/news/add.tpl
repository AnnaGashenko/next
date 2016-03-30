<div class="news">    
  <h1>ДОБАВЛЕНИЕ НОВОСТИ</h1>
  <form action="" method="post">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Заголовок новости</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td><input name="title" type="text" value="<?php echo @htmlspecialchars($_POST['title']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['title']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Категория новости</td>
        <td>
          <select class="goods_cat" name="cat">
            <option selected="selected" disabled>Выбирите категорию</option> 
            <?php while($row = $res->fetch_assoc()){  
            	echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';  
            } ?>  
          </select>
        </td>
        <td><span class="news_error"><?php echo @$errors['cat']; ?></span></td>
      </tr>
      <tr>
        <td><input type="hidden" name="cat_id" value="<?php echo $row['id']; ?>"></td>
      </tr>

      <tr>
        <td class="news_title">Описание новости</td>
        <td><textarea name="description"><?php echo @htmlspecialchars($_POST['description']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['description']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Полный текст новости</td>
        <td><textarea name="text"><?php echo @htmlspecialchars($_POST['text']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
    </table>
    <p style="font-size:10px">* - обязательные для заполнения</p>
    <input name="submit" type="submit" value="Добавить новость">
  </form>
</div>