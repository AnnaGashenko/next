<div class="news" style="padding-top:20px; padding-bottom:20px;">
  <h1><?php echo @$info; ?></h1>
  <div class="navigator">
    <ul>
    <?php while($row = $res->fetch_assoc()) { ?>
      <li><a href="/news/cat_news?cat=<?php echo $row['name']; ?>"><?php echo @htmlspecialchars($row['description']); ?></a>
      </li>
    <?php } ?> 
    </ul>
  </div>  
  
  <div class="goods_all_view">Все существующие новости:</div>
      <?php while($row = $result->fetch_assoc()) { ?>
          <div>
            <div>
              <table>
                <tr>
                  <!--Выводим заголовок и дату-->
                  <td width="400"><?php echo @htmlspecialchars($row['title']); ?></td>
                  <td width="140"><?php echo $row['date']; ?> </td>
                  <!--Ссылка на полную статью -->
                  <td width="100"><a href="/news/full_new?id=<?php echo $row['id']; ?>">ЧИТАТЬ ДАЛЕЕ</a></td>
                </tr>
              </table>
            </div>
          </div>
      <?php } $res->close(); ?>
</div><!-- /.news -->

<div class="paginator">
	<?php 
		  // вывод постраничной навигации
      Paginator::showPaginator(); 
    ?>    
</div> 
