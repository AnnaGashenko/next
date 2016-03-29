<div id="users" style="padding-top:20px; padding-bottom:20px;">
    <div class="navigator">
      <ul>
        <li><a href="/restaurant/">Статистика</a></li>        
        <li><a href="/restaurant/allDishes">Список всех блюд</a></li>
        <li><a href="/restaurant/orders">Список заказов</a></li>
        <li><a href="/restaurant/last_orders">5 последних заказов</a></li>
        <li><a href="/restaurant/popular5dishes">5 популярных блюд</a></li>
        <li><a href="/restaurant/best_waiters">Официанты выполнившие больше всего заказов</a></li>
      </ul>
    </div>
  <div class="clear"></div>

   <h2>Официанты выполнившие больше всего заказов</h2>  
   <br>
  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">Официант</th>
        <th>Количество заказов</th>
      </tr>    
    </thead>
    <tbody>
        <?php while($row = $waiters->fetch_assoc()) { ?>              
                <tr>
                  <td><?php echo $row['weiter_name']; ?></td>
                  <td><?php echo $row['COUNT( `weiter_name` )']; ?></td>
                </tr>
          <?php } ?>           
    </tbody>
  </table>

</div>
