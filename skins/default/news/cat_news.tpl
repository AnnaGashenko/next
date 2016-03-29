<div class="news">  
  <h1 class="goods_all_view">Новости категории:</h1>
  <?php while($row = $result->fetch_assoc()) { ?>
    <div class="post">  
      <!--Заголовок новости--> 
      <div class="post_title">
        <p class='post_name'><a href="/news/full_new?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></p>
        <p class='post_adds'>Дата добавления: <?php echo $row['date']; ?></p>
      </div>
      <!--Описание-->
      <p class='post_desc'><?php echo $row['description']; ?></p>     
    </div> 
  <?php } ?> 
</div>

<div class="paginator">
  <?php 
  	Paginator::$show_pages = 3;
  	// вывод постраничной навигации
    Paginator::showPaginator($cat); 
  ?>    
</div>