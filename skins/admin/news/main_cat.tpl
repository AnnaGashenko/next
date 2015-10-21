<div class="goods" style="padding-top:20px; padding-bottom:20px;">
    <div class="goods_add"><a href="/admin/news/add_cat">ДОБАВИТЬ КАТЕГОРИЮ</a></div>	
	<?php if(isset($info)) { ?>
        <h1 style="font-weight:bold; margin:20px 0;"><?php echo $info; ?></h1>
    <?php } ?>

    <br>
   <div class="goods_all_view"> Все существующие категории:</div>
   
    <form action="" method="post">
    
    <div>
      <div class="admin_table">        
        <table class="table">
        <thead>
          <tr class="r-l">
            <th width="20"><input type="checkbox"></th>
            <th width="100">Категория</th>
            <th width="100">Краткое описание</th>
            <th width="100">Удалить</th>
            <th width="100">Редактировать</th>
          </tr>
          </thead>
          <tbody>
          <?php while($row = $res->fetch_assoc()) { ?>
          <tr>
             <!--Создаем чекбоксы ids[] формируем массив с id-->
             <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
             <!--Выводим категорию-->
             <td width="200"><?php echo htmlspecialchars($row['name']); ?></td>
             <!--Выводим Краткое описание-->
             <td width="300"><?php echo htmlspecialchars($row['description']); ?></td>
             <!--Делаем ссылку и передаем параметры для удаления-->
             <td><a href="/admin/news/main_cat?action=delete&id=<?php echo $row['id']; ?>">
               <img src="/skins/admin/img/publish_r.png" width="16" height="16"></a>
             </td>
             <!--Делаем ссылку и передаем параметры для редактирования-->
             <td><a href="/admin/news/edit_cat?id=<?php echo $row['id']; ?>">
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
