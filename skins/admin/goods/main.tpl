<div class="goods" style="padding-top:20px; padding-bottom:20px;">
	<?php if(isset($info)) { ?>
        <h1 style="font-weight:bold; margin:20px 0;"><?php echo $info; ?></h1>
    <?php } ?>
    
    <div class="goods_add"><a href="/admin/goods/add">ДОБАВИТЬ ТОВАР</a></div>
    <br>
    <div class="goods_add"><a href="/admin/goods/main_cat">КАТЕГОРИИ</a></div>
    <br>
   <div class="goods_all_view"> Все существующие товары:</div>
   
    <form action="" method="post">
    
    <div>
      <div class="admin_table">        
        <table class="table">
        <thead>
          <tr class="r-l">
            <th width="20"><input type="checkbox"></th>
            <!--<th width="93">Изображение</th>-->
            <th width="100">Категория</th>
            <th width="100">Название</th>
            <th width="100">Удалить</th>
            <th width="100">Редактировать</th>
          </tr>
          </thead>
          <tbody>
          <?php while($row = $goods->fetch_assoc()) { ?>
          <tr>
             <!--Создаем чекбоксы ids[] формируем массив с id-->
             <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
             <!--Выводим категорию-->
             <td width="200"><?php echo htmlspecialchars($row['cat']); ?></td>
             <!--Выводим заголовок-->
             <td width="300"><?php echo htmlspecialchars($row['title']); ?></td>
             <!--Делаем ссылку и передаем параметры для удаления-->
             <td><a href="/admin/goods/main?action=delete&id=<?php echo $row['id']; ?>">
               <img src="/skins/admin/img/publish_r.png" width="16" height="16"></a>
             </td>
             <!--Делаем ссылку и передаем параметры для редактирования-->
             <td><a href="/admin/goods/edit?id=<?php echo $row['id']; ?>">
               <img src="/skins/admin/img/icon-16-edit.png" width="16" height="16"></a>
             </td>
          </tr> 
		  <?php } ?> 
          </tbody>
        </table>
      </div>
    </div>
          
    <!--Создаем кнопку для удаления выбранных чекбоксов-->
    <input class="submit" type="submit" name="delete" value="Удалить выбранные записи">
    </form>
</div>
