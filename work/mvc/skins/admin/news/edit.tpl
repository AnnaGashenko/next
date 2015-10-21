<div style="padding-top:20px; padding-bottom:20px;">

  <form action="" method="post">

    <div>
      Заголовок новости *: <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
    </div>

    <div>
      Категория новости: <input type="text" name="cat" value="<?php echo htmlspecialchars($row['cat']); ?>">
    </div>

    <div>
      Описание новости: <br>
      <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
    </div>

    <div>
      Полный текст новости: <br>
      <textarea name="text"><?php echo htmlspecialchars($row['text']); ?></textarea>
    </div>

    <input type="submit" name="ok" value="Отредактировать новость">
  </form>

</div>

