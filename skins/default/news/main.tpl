<div class="news" style="padding-top:20px; padding-bottom:20px;">
	<?php /*?><?php if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) { ?>
    <div>У вас не доступа</div>
    <?php } else { ?><?php */?>
        <h1><?php echo @$info; ?></h1>
            <div class="navigator">
              <ul>
               <?php while($row = $res->fetch_assoc()) { ?>
                <li><a href="/news/cat_news?cat=<?php echo $row['name']; ?>"><?php echo htmlspecialchars($row['description']); ?></a></li>
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
                        <td width="400"><?php echo htmlspecialchars($row['title']); ?></td>
                        <td width="140"><?php echo $row['date']; ?> </td>
                        <!--Ссылка на полную статью -->
                        <td width="100"><a href="/news/full_new?id=<?php echo $row['id']; ?>">ЧИТАТЬ ДАЛЕЕ</a></td>
                      </tr>
                    </table>
                  </div>
                </div>
            <?php } $res->close(); ?>
            <!--Создаем кнопку для удаления выбранных чекбоксов-->
   <?php /*?> <?php } ?><?php */?>
<div class="paginator">
	<?php 
	    Paginator::$show_pages = 3;
		// вывод постраничной навигации
        Paginator::showPaginator(); 
    ?>    
</div>
