<div id="users" style="padding-top:20px; padding-bottom:20px;">

	<?php if(isset($info)) { ?>
        <h1 style="font-weight:bold; margin:20px 0;"><?php echo $info; ?></h1>
    <?php } ?>

                                          
    <h2> Список пользователей:</h2>   
                                     <!--  Поиск пользователей  --> 
  
     <div class="form_find_users">
         <form action="" method="get">
            <table>
              <tr>
                <td>
                  <input type="text" name="search" placeholder="Поиск">
                </td>
                <td>
                  <input type="submit" name="submit_search" value="">
                </td>
              </tr>
            </table>
         </form>
     </div>

   <div class="clear"></div>
   
                                          <!-- Вывод всех пользователей  -->  
  
    <table class="all_users">
      <thead>
        <tr>
          <th class="r-l">ID</th>
          <th>E-mail</th>
          <th>Пользователь</th>
          <th>Дата регистрации</th>
          <th class="r-r">Дата последней активности</th>
        </tr>    
      </thead>
    <tbody>
        <?php if(!empty($_GET['search'] )) { ?> 
                <tr>
                  <td><?php echo $res['id']; ?></td>
                  <td><?php echo $res['email']; ?></td>
                  <td>               
                    <a href="/admin/users/users_edit?id=<?php echo $res['id']; ?>"><?php echo htmlspecialchars($res['login']); ?></a>
                  </td>
                  <td><?php echo $res['date_registration']; ?></td>
                  <td><?php echo $res['date_active']; ?></td>
                </tr>
       <?php  } else { 
            while($row = $users->fetch_assoc()) { ?>              
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td>               
                    <a href="/admin/users/users_edit?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['login']); ?></a>
                  </td>
                  <td><?php echo $row['date_registration']; ?></td>
                  <td><?php echo $row['date_active']; ?></td>
                </tr>
        	<?php }   
        } ?>           
    </tbody>
</table>
        
</div>
