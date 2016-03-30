<div class="news">    
  <h1>редактирование Категории</h1>
  <form action="" method="post" >
    <table border="0" cellspacing="0" cellpadding="0">        
      <tr>
        <td class="news_title">Название категории</td>
        <!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
        <td>
            <input class="title_area" name="name" type="text" value="<?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['name']) : htmlspecialchars($row['name'])?>">
        </td>
        <td><span class="news_error"><?php echo @$error; ?></span></td>
      </tr>
      <tr>
        <td class="news_title">Краткое описание категории</td>
        <td><textarea name="description"><?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['description']) : htmlspecialchars($row['description']); ?></textarea></td>
      </tr>
      <tr>
        <td class="news_title">Описание категории<br></td>
        <td><textarea name="text"><?php echo (isset($_POST['edit'])) ? htmlspecialchars($_POST['text']) : htmlspecialchars($row['text']); ?></textarea></td>
      </tr>  
      <p style="font-size:10px">* - обязательные для заполнения</p>
      <tr>
        <td></td>
        
        <td><input name="edit" type="submit" value="Отредактировать товар"></td>
      </tr>
    </table>
  </form>
</div>