<div class="news">    
  <h1>РЕДАКТИРОВАНИЕ ТОВАРА</h1>
  
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Фото товара</td>
        <td class="news_title">
        <img src="<?php echo $row['book_small']  ?>">
          <form action="" method="post" enctype="multipart/form-data">
            <!--  Поле для ввода имени файла, который пересылается на сервер-->  
            <input type="file" name="file">
        </td>
		<td><span class="news_error"><?php echo @$errors['file']; ?></span></td>       
      </tr>  
      <tr>
        <td class="news_title">Название товара</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td>
            <input class="title_area" name="title" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['title']) : htmlspecialchars($row['title'])?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['title']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Автор</td>
        <td>
            <select class="books_cat" name="author[]" size="5" multiple>
            <?php 
            while($row2 = $author->fetch_assoc()) {
echo '<option '.(((isset($_POST['edit']) && in_array($row2['id'], $_POST['author'])) || (!isset($_POST['edit']) && in_array($row2['id'], $ids))) ? 'selected' : '').' value="'.htmlAll($row2['id']).'">'.htmlspecialchars($row2['author']).'</option>';
			}
            ?> 
            </select>
        </td>
        <td><span class="news_error"><?php echo @$errors['author']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Код товара</td>
        <td>
          <input name="cod" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlAll($_POST['cod']) : htmlAll($row['cod']); ?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['cod']; ?></span></td>
      </tr>
      <tr>
      <tr>
        <td class="news_title">Краткое описание товара</td>
        <td><textarea name="description"><?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['description']) : htmlspecialchars($row['description']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['description']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Основные характеристики товара<br></td>
        <td><textarea name="text"><?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['text']) : htmlspecialchars($row['text']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Цена товара</td>
        <td>
          <input name="price" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['price']) : htmlspecialchars($row['price'])?>">
        </td>
        <td><span class="news_error"><?php echo @$errors['price']; ?></span></td>
      </tr>
  
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        
        <td><input name="edit" type="submit" value="Отредактировать товар"></td>
      </tr>
    </table>
   </form>
</div>