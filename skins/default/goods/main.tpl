<div class="goods" style="padding-top:20px; padding-bottom:20px;">
  <h1><?php echo @$info; ?></h1>
  <div class="navigator">
    <ul>
		<?php while($row = $res->fetch_assoc()) { ?>
      <li><a href="/goods/cat_goods?cat=<?php echo $row['name']; ?>"><?php echo htmlspecialchars($row['name']); ?></a>
      </li>
    <?php } ?> 
    </ul>
  </div>  
  <div class="goods_all_view">Все существующие товары:</div>
      <?php while($row = $goods->fetch_assoc()) { ?>
        <div id="goods_conteiner">
            <div class="left_part">
              <div class="img"><a href="/goods/full_good?id=<?php echo $row['id']; ?>">
              <img src="<?php echo $row['photo_big']; ?>"></div></a>
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






<!--<div>
  <div class="left_part">
    <img src="./uploaded/avatar/100x100/small_20150203-164134img53926.jpg" width="100" height="67">
  </div>
  <div class="right_part">
    <div class="goods_title">НАЗВАНИЕ</div>
    <div class="goods_description">ОПИСАНИЕ</div>
  </div>
</div>
-->


