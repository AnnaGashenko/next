<div class="news">    
  <h1>РЕДАКТИРОВАНИЕ НОВОСТИ</h1>
  <form action="" method="post">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Заголовок новости</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td width="430"><input name="title" type="text" value="<?php echo htmlspecialchars($row['title']); ?>"></td>
      </tr>
      <tr>
        <td class="news_title">Категория новости</td>
        <td>
            <select class="goods_cat" name="cat">
            <?php 
            while($row2 = $res->fetch_assoc()) {
				echo '<option '.(((isset($_POST['edit']) && $_POST['cat'] == $row2['name']) || (!isset($_POST['edit']) && $row['cat'] == $row2['name'])) ? 'selected="selected"' : '').' value="'.htmlAll($row2['name']).'">'.htmlspecialchars($row2['name']).'</option>';         
            }
            ?> 
            </select>
        </td>
        <td><span class="news_error"><?php echo @$errors['cat']; ?></span></td>
      </tr>
      <tr>
        <td><input type="hidden" name="cat_id" value="<?php echo $row2['id']; ?>"></td>
      </tr>
      <tr>
        <td class="news_title">Описание новости<br></td>
        <td><textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea></td>
      </tr>
      <tr>
        <td class="news_title">Полный текст новости<br></td>
        <td><textarea name="text"><?php echo htmlspecialchars($row['text']); ?></textarea></td>
      </tr>
  
    <p style="font-size:10px">* - обязательные для заполнения</p>
    <tr>
    <td></td>
    <td><input name="edit" type="submit" value="Отредактировать новость"></td>
    
    </table>
  </form>
</div>