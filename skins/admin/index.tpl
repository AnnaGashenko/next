<!DOCTYPE HTML>
<html>
 <head>
  <title><?php echo htmlAll(Core::$META['title']); ?></title>
  <meta name="description" content="<?php echo htmlAll(Core::$META['description']); ?>">
  <meta name="keywords" content="<?php echo htmlAll(Core::$META['keywords']); ?>">
  <link href="/skins/<?php echo Core::$SKIN; ?>/css/style.css" type="text/css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

 </head >

 <body >
 
	<div id="wrapper">  
    <div class="fix">
		  <div class="box-fixed">
			  <div class="header">
		      <div class="logo"><a href="/admin">CMS</a></div>
            <div class="block_right">
              <?php if(isset($_SESSION['user'])){ ?>
                Зравствуйте, <a href="#"> <?php echo $_SESSION['user']['login']; ?></a> 
                <div class="view_site"> Просмотр 
                  <a href="/">сайта <span> → </span></a>
                </div>
              <?php } ?>  
            </div>
          </div>
          <?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 5 ) { ?>
            <ul class="nav">
              <li><a href="/admin">ГЛАВНАЯ</a></li>
              <li><a href="/admin/news">НОВОСТИ</a></li>
              <li><a href="/admin/goods">ТОВАРЫ</a></li>
              <li><a href="/admin/books">КНИГИ</a></li>
              <li><a href="/admin/users">ПОЛЬЗОВАТЕЛИ</a></li>
             	<li><a href="/cab/exit">ВЫХОД</a></li>
            </ul>
          <?php } ?>
          <div class="clear"></div>
        </div>
		</div>	   
			
    <div id="conteiner">
      <!--РОУТЕР-->
      <?php echo $content; ?>          
    </div>
         
    <!--Буффер-->
    <div id="footer_space"></div>

	</div> <!--Конец wrapper-->
          
  <div id="footer">          
    <div class="copyright">&copy 
     <?php 			    
        if(Core::$CREATED == date("Y")){
          echo Core::$CREATED;
        } else {
          echo Core::$CREATED.' - '.date("Y");
        }
     ?>
      Представленная торговая марка, имя бренда и фотографии являются собственностью их правообладателя Next Group PLC. 
    </div>
  </div> <!--/ #footer-->

 </body>
</html>
