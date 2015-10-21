<div class="news">  
<h1 class="goods_all_view">Новости категории: </h1>

  <?php while($row = $res->fetch_assoc()) { ?>
    <div class="post">  
      <!--Заголовок новости--> 
      <div class="post_title">
        <p class='post_name'><a href="/news/full_new?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></p>
        <p class='post_adds'>Автор: <?php echo $row['author']; ?></p>
      </div>
      <!--Описание-->
      <p class='post_desc'><?php echo $row['text']; ?></p>     
    </div>
  <?php } $res->close(); ?> 
</div>