<div class="goods">  
<h1 class="goods_all_view">Товары категории: </h1>
  <?php while($row = $result->fetch_assoc()) { ?>
    <div id="goods_conteiner">
        <div class="left_part">
          <div class="img"><a href="/goods/full_good?id=<?php echo $row['id']; ?>">
          <img src="<?php echo $row['good_big']; ?>"></div></a>
        </div>
        
        <div class="right_part">
          <!--Выводим заголовок-->
          <div class="goods_title"><a href="/goods/full_good?id=<?php echo $row['id']; ?>">
           <?php echo htmlspecialchars($row['title']); ?></a>
          </div>
          <br>
          <div class="goods_description"><?php echo $row['description']; ?>
            <!--Ссылка на полную статью -->
            <a class="underline" href="/goods/full_good?id=<?php echo $row['id']; ?>"> Подробнее → </a>
          </div>
        </div>
    </div>
  <div class="clear"></div>
  <?php } ?> 
</div>
<!-- Вывод постраничной навигации -->
<?php 
  Paginator::showPaginator($cat); 
?>    
