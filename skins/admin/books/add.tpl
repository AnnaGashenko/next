<div class="news">    
  <h1>ДОБАВЛЕНИЕ КНИГИ</h1>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Фото книги</td>
        <td class="news_title">
          <form action="" method="post" enctype="multipart/form-data">
            <!--  Поле для ввода имени файла, который пересылается на сервер-->  
            <input type="file" name="file">
        </td>
 	    <td><span class="news_error"><?php echo @$errors['file']; ?></span></td>      
      </tr>  
      <tr>
        <td class="news_title" width="200">Заголовок книги</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td><input name="title" type="text" value="<?php echo @htmlspecialchars($_POST['title']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['title']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Автор книги</td>
        <td>
          <select class="goods_cat" name="author[]" size="5" multiple>
            <option selected="selected" disabled>Выбирите автора</option> 
            <?php 
                while($row = $author->fetch_assoc()){  
                	echo '<option value="'.$row['id'].'">'.$row['author'].'</option>';  
                }   
            ?> 
          </select>
        </td>
        <td><span class="news_error"><?php echo @$errors['author']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Код книги</td>
        <td><input name="cod" type="text" value="<?php echo @htmlspecialchars($_POST['cod']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['cod']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Краткое описание книги</td>
        <td><textarea name="description"><?php echo @htmlspecialchars($_POST['description']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['description']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Текст</td>
        <td><textarea name="text"><?php echo @htmlspecialchars($_POST['text']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Цена</td>
        <td><input name="price" type="text" value="<?php echo @htmlspecialchars($_POST['price']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['price']; ?></span></td>
      </tr>
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        <td><input name="add" type="submit" value="Добавить книгу"></td>
      </tr>
    </table>
  </form>
</div>



