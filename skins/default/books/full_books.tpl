<div class="full_book">  
    <h1> <p class="full_title" ><?php echo htmlAll($row['title']); ?></p></h1>
    <div class="img"><img src="<?php echo $row['book_big']; ?>"></div>
    
    <div class="right_box">
        <div class="name">Автор: </div>
        <?php  while($row3 = $res3->fetch_array()) { ?>
              <!--Передаем через $_GET id автора-->
          <div class="link_author">
            <a href="/books/author_books?id=<?php echo $row3['id']; ?>"><?php echo htmlAll($row3['author']); ?></a>
          </div>
        <?php } ?>
        <div class="clear"></div>
        <div class="name">Код: </div>
        <div><?php echo htmlAll($row['cod']); ?></div>
        <div class="name">Цена: </div>
        <div><?php echo htmlAll($row['price']); ?> грн.</div>
    </div>
    <div class="clear"></div>
    <div class="product-description">
      <p class="book_title"> Описание</p>
      <p class="post_text"><?php echo htmlAll($row['text']); ?></p>
    </div>
</div>