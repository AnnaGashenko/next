<div class="books" style="padding-top:20px; padding-bottom:20px;">
        <h1><?php echo @$info; ?></h1>
        <div class="goods_all_view">Все книги:</div>
			<?php while($row = $books->fetch_assoc()) { ?>
            <div class="book_box">
              <div class="img">
                <a href="/books/full_books?id=<?php echo $row['id']; ?>">
                  <img src="<?php echo $row['book_small']; ?>">
                </a>
              </div>
              <div class="title">
                <a href="/books/full_books?id=<?php echo $row['id']; ?>">
			      <?php echo htmlspecialchars($row['title']); ?>
                </a>
              </div>
              <div class="price"><?php echo htmlspecialchars($row['price']); ?> грн.</div>
            </div>
            <?php } ?>
            
</div>
