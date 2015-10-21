<div class="goods style="padding-top:20px; padding-bottom:20px;">
	<?php if(isset($info)) { ?>
        <h1 style="font-weight:bold; margin:20px 0;"><?php echo $info; ?></h1>
    <?php } ?>
    
    <div class="goods_add"><a href="/index.php?module=goods&page=add">ДОБАВИТЬ ТОВАР</a></div>
    <br>
   <div class="goods_all_view"> Все существующие товары:</div>
   
    <form action="" method="post">
    <?php while($row = mysqli_fetch_assoc($goods)) { ?>
    <div>
      <div>        
        <table>
          <tr>
             <!--Создаем чекбоксы ids[] формируем массив с id-->
             <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
             <!--Выводим заголовок-->
             <td width="300"><?php echo htmlspecialchars($row['title']); ?></td>
             <!--Делаем ссылку и передаем параметры для удаления-->
             <td><a href="index.php?module=goods&action=delete&id=<?php echo $row['id']; ?>">УДАЛИТЬ</a></td>
             <!--Делаем ссылку и передаем параметры для редактирования-->
             <td><a href="index.php?module=goods&page=edit&id=<?php echo $row['id']; ?>">РЕДАКТИРОВАТЬ</a></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <?php } ?>        
    <!--Создаем кнопку для удаления выбранных чекбоксов-->
    <input class="goods_del_submit" type="submit" name="delete" value="Удалить выбранные записи">
    </form>
</div>
