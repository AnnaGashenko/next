<div id="users" style="padding-top:20px; padding-bottom:20px;">

    <div class="navigator">
      <ul>
        <li><a href="/restaurant/">Статистика</a></li>        
        <li><a href="/restaurant/allDishes">Список всех блюд</a></li>
        <li><a href="/restaurant/orders">Список всех заказов</a></li>
        <li><a href="/restaurant/last_orders">5 последних заказов</a></li>
        <li><a href="/restaurant/popular5dishes">5 популярных блюд</a></li>
        <li><a href="/restaurant/best_waiters">Официанты выполнившие больше всего заказов</a></li>
      </ul>
    </div>
  <div class="clear"></div>

  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">ID</th>
        <th>Название</th>
        <th>Цена</th>
      </tr>    
    </thead>
    <tbody>
        <?php if(!empty($_GET['search'] )) { 
          while($row_search = $search->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $row_search['id']; ?></td>
                  <td><?php echo $row_search['title_dish']; ?></td>
                  <td><?php echo $row_search['price']; ?></td>
                </tr>
          <?php } ?>
       <?php  } else { 
            while($row = $dishes->fetch_assoc()) { ?>              
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title_dish']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                </tr>
          <?php }   
        } ?>           
    </tbody>
  </table>

</div>
