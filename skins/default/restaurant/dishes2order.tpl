<div id="users" style="padding-top:20px; padding-bottom:20px;">
    <div class="navigator">
      <ul>
        <li><a href="/restaurant/">Статистика</a></li>                
        <li><a href="/restaurant/allDishes">Список всех блюд</a></li>
        <li><a href="/restaurant/orders">Список заказов</a></li>
        <li><a href="/restaurant/last_orders">5 последних заказов</a></li>
        <li><a href="/restaurant/popular5dishes">5 популярных блюд</a></li>
      </ul>
    </div>
  <div class="clear"></div>
  
   <h2> Список блюд в заказе № <?php echo $_GET['id']; ?></h2>  
   <br>
  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">id блюда</th>
        <th>Название блюда</th>
        <th>Цена (грн)</th>
        <th>Количество</th>
      </tr>    
    </thead>
    <tbody>
        <?php while($row_dishes = $dishes->fetch_assoc()) { ?>              
                <tr>
                  <td><?php echo $row_dishes['id']; ?></td>
                  <td><?php echo $row_dishes['title_dish']; ?></td>
                  <td><?php echo $row_dishes['price']; ?></td>
                  <td><?php echo $row_dishes['count']; ?></td>
                </tr>
          <?php } ?>           
    </tbody>
  </table>

</div>
