<div class="goods" style="padding-top:20px; padding-bottom:20px;">
	<?php if(isset($info)) { ?>
    <h1 style="font-weight:bold; margin:20px 0;"><?php echo $info; ?></h1>
  <?php } ?>

    <div class="navigator">
      <ul>
        <li><a href="/admin/books/add">ДОБАВИТЬ КНИГУ</a></li>
        <li><a href="/admin/books/add_author">ДОБАВИТЬ АВТОРА</a></li>
      </ul>
    </div>
	<div class="clear"></div>
   
   
  <form action="" method="post">
    <div>
      <div class="admin_table">     
        <table class="table">
        <thead>
          <tr class="r-l">
            <th><input type="checkbox"></th>
            <!--<th width="93">Изображение</th>-->
            <th>Название</th>
            <th>Цена</th>
            <th>Удалить</th>
            <th>Редактировать</th>
          </tr>
          </thead>
          <tbody>
          <?php while($row = $books->fetch_assoc()) { ?>
            <tr>
               <!--Создаем чекбоксы ids[] формируем массив с id-->
               <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
               <!--Выводим заголовок-->
               <td width="300"><?php echo htmlspecialchars($row['title']); ?></td>
               <!--Цена-->
               <td width="300"><?php echo htmlspecialchars($row['price']); ?></td>
               <!--Делаем ссылку и передаем параметры для удаления-->
               <td><a href="/admin/books/main?action=delete&id=<?php echo $row['id']; ?>">
                 <img src="/skins/admin/img/publish_r.png" width="16" height="16"></a>
               </td>
               <!--Делаем ссылку и передаем параметры для редактирования-->
               <td><a href="/admin/books/edit?id=<?php echo $row['id']; ?>">
                 <img src="/skins/admin/img/icon-16-edit.png" width="16" height="16"></a>
               </td>
            </tr> 
		      <?php } ?> 
          </tbody>
        </table>
      </div>
    </div>
          
    <!--Создаем кнопку для удаления выбранных чекбоксов-->
    <input class="submit" type="submit" name="delete" value="Удалить выбранные книги">
  </form>
</div>
