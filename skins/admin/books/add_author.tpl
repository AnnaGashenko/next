<div class="news">    
  <h1>ДОБАВЛЕНИЕ АВТОРА</h1>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news_title">Фото автора</td>
        <td class="news_title">
          <form action="" method="post" enctype="multipart/form-data">
            <!--  Поле для ввода имени файла, который пересылается на сервер-->  
            <input type="file" name="file">
        </td>
 	    <td><span class="news_error"><?php echo @$errors['file']; ?></span></td>      
      </tr>  
      <tr>
        <td class="news_title">Автор*</td>
        <td><input name="author" type="text" value="<?php echo @htmlspecialchars($_POST['author']); ?>"></td>
        <td><span class="news_error"><?php echo @$errors['author']; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Биография *</td>
        <td><textarea name="text"><?php echo @htmlspecialchars($_POST['text']); ?></textarea></td>
        <td style="vertical-align:middle"><span class="news_error"><?php echo @$errors['text']; ?></span></td>
      </tr>
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        <td><input name="add" type="submit" value="Добавить автора"></td>
      </tr>
    </table>
  </form>
</div>



