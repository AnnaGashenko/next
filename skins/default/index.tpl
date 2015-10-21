<!DOCTYPE HTML>
<html>
 <head>
  <title><?php echo htmlAll(Core::$META['title']); ?></title>
  <meta name="description" content="<?php echo htmlAll(Core::$META['description']); ?>">
  <meta name="keywords" content="<?php echo htmlAll(Core::$META['keywords']); ?>">
  <link href="/skins/<?php echo Core::$SKIN; ?>/css/style.css" type="text/css" rel="stylesheet">
    <!-- Bootstrap -->
<!--  <link href="/skins/<?php echo Core::$SKIN; ?>/css/bootstrap.css" rel="stylesheet">
-->  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="/skins/<?php echo Core::$SKIN; ?>/js/authorization.js"></script>
  <noscript><span>У Вас отключён JavaScript...</span></noscript>
 </head >

 <body >
	<div id="wrapper">  
      <div class="fix">
		<div class="box-fixed">
		  <div class="header">
		    <div class="logo"><a href="/"></a></div>
               <div class="block_right">
                 <?php if (!isset($_SESSION['user'])) { ?>
                     <div class="login"><a href="#">Войти</a></div>
                     <div class="registr"><a href="/cab/registration">Регистрация</a></div>
                     
                                         <!--АВТОРИЗАЦИЯ-->
                    <?php if(!isset($_COOKIE['auto_autoauth_hash'], $_COOKIE['auto_autoauth_id'] )) { 
                       if(!isset($status) || $status != 'OK')  {    ?>
                       <div id="modal_window">
                         <form class="form-container" action="/cab/auth" method="post" name="auth" id="authorization">
                            <div class="form-title"><h2>Авторизация</h2></div>
                            <div class="form-title">Логин</div>
                            <input class="form-field" name="login" type="text" id="auth_login" placeholder="введите логин"><br >
                            <div class="form-title">Пароль</div>
                            <input class="form-field" name="pass" type="password" id="auth_pass" placeholder="введите пароль"><br >
                            <div style="color: red; display: none" id="errors"></div><br>
                              <div class="form-remember">
                                <label for="check">Запомнить:</label>
                                <div class="check"><input name="autoauth" type="checkbox" id="auth_check"></div>
                                <br>
                                <br>
                              </div>
                            <div class="submit-container">
                            <input class="submit-button" type="submit" name="submit" id="submit" value="Вход">
                            </div>
                         </form>
                         </div>
                      <?php } }  ?>

                     
				 <?php } else {?>
                     <div class="button_exit"><a href="/cab/exit">ВЫХОД</a></div>
                     <div class="user">
                       <img src="<?php echo $_SESSION['user']['avatar_small']; ?>">
                       <a href="/cab/user_edit/<?php echo $_SESSION['user']['id']; ?>"> <?php echo $_SESSION['user']['login']; ?></a>
                     </div>
                 <?php } ?>
                   <div class="clear"></div>
                   <div class="shop_bag">
                     <a href="/">
                       <span class="summa">товаров (0) <br> 0.00 грн</span>
                       <img src="/skins/<?php echo Core::$SKIN; ?>/img/shopping_cart.png" width="26" height="31" alt="cart">                     </a>
                     <div class="clear"></div>
                   </div>
                 </div>
                 
                 <div id="nav_header">
                   <ul class="nav_header">
				     <li><a href="/" class="active">контакты</a></li>
				     <li><a href="/">доставка и оплата</a></li>
				     <li><a href="/">таблица размеров</a></li>
				   </ul>
                 </div>
                 
                 <div class="clear"></div>
                 
                 <div class="search">
                   <form action="" method="post" name="search">
                     <input name="text" type="text" size="40" class="search_pole">
                     <input name="submit" type="submit" value="поиск" class="button_find">
                     <div class="clear"></div>
                   </form>
                 </div> 
              </div>

                                      
               <div id="main_menu">
				 <ul class="nav">
                   <li><a href="#">ОДЕЖДА ДЛЯ ДЕВОЧЕК</a></li>
                   <li><a href="#">ОДЕЖДА ДЛЯ МАЛЬЧИКОВ </a></li>
                   <li><a href="#">ОДЕЖДА ДЛЯ НОВОРОЖДЕННЫХ</a></li>
                
                   
                   <li><a href="/authorization">АВТОРИЗАЦИЯ</a></li>
                   <li><a href="/bitva_alcogolicov">БИТВА АЛКОГОЛИКОВ</a></li>
                   <li><a href="/fileManager">ФАЙЛ МЕНЕДЖЕР</a></li>
				 </ul>
                 <div class="clear"></div>
                 
				 <ul class="nav">
                  <!-- <li><a href="/admin">АДМИНКА</a></li>-->
                   <li><a href="/reviews">ОТЗЫВЫ</a></li>
                   <li><a href="/news">НОВОСТИ</a></li>
                   <li><a href="/goods">ТОВАРЫ</a></li>
                   <li><a href="/books">КНИГИ</a></li>
				   <?php 
				   		if((isset($_SESSION['user']) && $_SESSION['user']['access'] == 5)) {
                        	echo'<li><a href="/admin">АДМИНКА</a></li>';
                        }
                   ?>
                 </ul>
               </div>	
				 <ul class="map">
                   <li><a href="/" class="active">ДОСТАВКА ЗА 7 ДНЕЙ</a></li>
                   <li><a href="/">БЕСПЛАТНАЯ ДОСТАВКА НА ВСЕ ЗАКАЗЫ ОТ 250 ГРН</a></li>
                   <li><a href="/">ВОЗМОЖНОСТЬ ОФОРМЛЕНИЯ ЗАКАЗА БЕЗ РЕГИСТРАЦИИ</a></li>
				 </ul>
                 <div class="clear"></div>
          </div>
		</div>	
			
        <div class="conteiner">
         <!--РОУТЕР-->
		 <?php echo $content; ?>          
        </div>
        
      <!--Буффер-->
      <div id="footer_space"></div>

<!--Конец wrapper-->
	</div>
    
	
    
    <!--Footer-->
    <div id="footer">
          <ul class="nav_footer">
            <li><a href="/" class="active">Мой аккаунт</a></li>
            <li><a href="/">Доставка</a></li>
            <li><a href="/">Таблица размеров</a></li>
            <li><a href="/">О нас</a></li>
            <li><a href="/">Отзывы</a></li>
            <li><a href="/">Контакты</a></li>
            <li><a href="/">FAQ</a></li>
          </ul>
          <div class="clear"></div>
          
          <div class="news">
            <div class="title_news">БУДЬТЕ В КУРСЕ</div>
            <div class="description_news">Подпишитесь на эксклюзивные предложения и новости</div>
            <form action="" method="post" name="get_news">
              <input name="email" type="text" size="40" placeholder="Enter email address" class="search_pole">
              <input name="submit" type="submit" class="but" value="">
            </form>       
          </div>
                  
          <div class="pay">
            <div class="visa"></div>
            <div class="mastercard"></div>
            <div class="privat24"></div>
            <div class="clear"></div>
          </div>    
                  
          <div class="follow">                  
            <div class="title_follow">ПРИСОЕДИНЯЙТЕСЬ</div>
            <div class="description_follow">Пройдя по ссылкам с иконок, вы попадете на официальные странички в социальных сетях:</div>
            <div class="pic_follow">   
              <div class="vkontakte"><a href="/"></a></div>                    
              <div class="twetter"><a href="/"></a></div>
              <div class="facebook"><a href="/"></a></div>
              <div class="clear"></div>
            </div>                                
          </div>
             
          <div class="copyright">&copy 
           <?php 			    
               if(Core::$CREATED == date("Y")){
                 echo Core::$CREATED;
               }
               else{
                 echo Core::$CREATED.' - '.date("Y");
               }
           ?>
            Представленная торговая марка, имя бренда и фотографии являются собственностью их правообладателя Next Group PLC. 
          </div>
	</div>
 </body>
</html>
