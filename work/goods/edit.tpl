<div class="news">    
  <h1>РЕДАКТИРОВАНИЕ ТОВАРА</h1>
  <form action="" method="post">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Заголовок товара</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td><input name="title" type="text" value="<?php echo htmlspecialchars($row['title']); ?>"></td>
      </tr>
      <tr>
        <td class="news_title">Код товара</td>
        <td><input name="cod" type="text" value="<?php echo htmlspecialchars($row['cod']); ?>"></td>
      </tr>
      <tr>
      <tr>
        <td class="news_title">Категория товара</td>
        <td><input name="cat" type="text" value="<?php echo htmlspecialchars($row['cat']); ?>"></td>
      </tr>
      <tr>
        <td class="news_title">Описание товара<br></td>
        <td><textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea></td>
      </tr>
      <tr>
        <td class="news_title">Основные характеристики товара<br></td>
        <td><textarea name="text"><?php echo htmlspecialchars($row['text']); ?></textarea></td>
      </tr>
      <tr>
        <td class="news_title">Цена товара</td>
        <td><input name="price" type="text" value="<?php echo htmlspecialchars($row['price']); ?>"></td>
      </tr>
  
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        <td><input name="edit" type="submit" value="Отредактировать товар"></td>
      </tr>
    
    </table>
  </form>
</div>