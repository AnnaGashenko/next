<div class="books" style="padding-top:20px; padding-bottom:20px;">
  <h1><?php echo @$info; ?></h1>
  <div class="goods_all_view">Все книги <?php echo $row['author']; ?>:</div>
  <?php while($row3 = $books->fetch_assoc()) { ?>
    <div class="book_box">
      <div class="img">
        <a href="/books/full_books?id=<?php echo $row3['id']; ?>">
          <img src="<?php echo $row3['photo_small']; ?>">
        </a>
      </div>

      <div class="title">
        <a href="/books/full_books?id=<?php echo $row3['id']; ?>">
          <?php echo htmlspecialchars($row3['title']); ?>
        </a>
      </div>

      <div class="price"><?php echo htmlspecialchars($row3['price']); ?> грн.</div>
    </div> <!-- /.book_box -->
  <?php } ?>
</div>
