<div style="padding-top:20px; padding-bottom:20px;">
<?php if(isset($info)) { ?>
  <h1><?php echo $info; ?></h1>
<?php } ?>

<a href="/news/add">ДОБАВИТЬ НОВУЮ НОВОСТЬ</a>
<br>
Все существующие новости:
<form action="" method="post">
<?php while($row = $news->fetch_assoc()) { ?>
<div>
  <div><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"> <a href="index.php?module=news&page=edit&id=<?php echo $row['id']; ?>">ОТРЕДАКТИРОВАТЬ</a> <a href="/news/main/delete/<?php echo $row['id']; ?>">УДАЛИТЬ</a> <b><?php echo $row['title']; ?></b> <span style="color:#777777; font-size:10px;"><?php echo $row['date']; ?></span></div>
</div>
<hr>
<?php } ?>
<input type="submit" name="delete" value="Удалить отмеченные записи">
</form>
</div>
