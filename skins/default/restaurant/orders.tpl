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

<div class="info_order">Кликните по номеру заказа, чтобы просмотреть "Список блюд в заказе"</div>

  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">№ заказа</th>
        <th>Официант</th>
        <th>Дата заказа</th>
        <th>Сумма заказа</th>
      </tr>    
    </thead>
    <tbody>
        <?php while($row = $orders->fetch_assoc()) { ?>              
                <tr>
                  <td>
                      <a href="/restaurant/dishes2order?id=<?php echo $row['id']; ?>">
                        <?php echo $row['id']; ?>
                      </a>
                  </td>
                  <td><?php echo $row['weiter_name']; ?></td>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php echo $row['summ_order']; ?></td>
                </tr>
          <?php } ?>           
    </tbody>
  </table>

</div>
