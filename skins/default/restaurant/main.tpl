<!--Чтобы лучше тестировать работу скрипта, установим таймер для обновления версии с каждой перезагрузкой страницы-->
<script type="text/javascript" src="/skins/<?php echo Core::$SKIN; ?>/js/restaurant.js?t=<?php echo time(); ?>"></script>
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

  <div class="title_orders"> Заказы за сегодня и итоговая сумма</div>
  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">№ заказа</th>
        <th>Официант</th>
        <th>Дата заказа</th>
        <th>Сумма заказа</th>
      </tr>    
    </thead>
    <tbody class="lastOrders">
        <?php if(mysqli_num_rows($result)) { ?> 
          <?php while($row = $result->fetch_assoc()) { ?>              
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
        <?php } else { echo '<div class="noOrders">Нет заказов за сегодня';} ?>         
          <?php while($row = $OrderTotal->fetch_assoc()) { ?>              
                <tr id="SummForDay">
                  <td class="tableTitle" colspan="3">ИТОГО:</td>
                  <td class="tableTitle summaForDay"><?php echo $row['OrderTotal']; ?></td>
                </tr>
          <?php } ?> 
    </tbody>
  </table>

  <div class="title_orders"> Пять последних заказов</div>
  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">№ заказа</th>
        <th>Официант</th>
        <th>Дата заказа</th>
        <th>Сумма заказа</th>
      </tr>    
    </thead>
    <tbody class="lastOrders">
        <?php while($row = $last5orders->fetch_assoc()) { ?>              
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

  <div class="title_orders"> 5 самых популярных блюд</div>
  <table class="all_users">
    <thead>
      <tr>
        <th class="r-l">id блюда</th>
        <th>Название блюда</th>
        <th>Цена (грн)</th>
      </tr>    
    </thead>
    <tbody class="popular5dishes">
        <?php while($row_dishes = $dishes->fetch_assoc()) { ?>              
                <tr>
                  <td><?php echo $row_dishes['id']; ?></td>
                  <td><?php echo $row_dishes['title_dish']; ?></td>
                  <td><?php echo $row_dishes['price']; ?></td>
                </tr>
          <?php } ?>           
    </tbody>
  </table>

</div>
