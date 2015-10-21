<div class="news">    
  <h1>ДОБАВЛЕНИЕ ТОРАВА</h1>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Фото товара</td>
        <td class="news_title">
          <form action="" method="post" enctype="multipart/form-data">
            <!--  Поле для ввода имени файла, который пересылается на сервер-->  
            <input type="file" name="file">
        </td>
 	    <td><span class="news_error"><?php echo @$errors['file']; ?></span></td>      
      </tr>  
      <tr>
        <td class="news_title" width="200">Заголовок товара</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td><input name="title" type="text" value="<?php echo htmlAll($_POST['title']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['title']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Категория товара</td>
        <td>
          <select class="goods_cat" name="cat">
            <option selected="selected" disabled>Выбирите категорию</option> 
            <?php 
                while($row = $res->fetch_assoc()){  
                	echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';  
                }   
            ?> 
          </select>
        </td>
        <td><span class="news_error"><?php echo @$errors['cat']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Код товара</td>
        <td><input name="cod" type="text" value="<?php echo htmlAll($_POST['cod']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['cod']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Краткое описание товара</td>
        <td><textarea name="description"><?php echo htmlAll($_POST['description']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['description']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Основные характеристики товара</td>
        <td><textarea name="text"><?php echo htmlAll($_POST['text']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Цена товара</td>
        <td><input name="price" type="text" value="<?php echo htmlAll($_POST['price']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['price']; ?></span></td>
      </tr>
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        <td><input name="add" type="submit" value="Добавить товар"></td>
      </tr>
    </table>
  </form>
</div>



