<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo hc(Core::$META['title']); ?></title>
<meta name="description" content="<?php echo hc(Core::$META['description']); ?>">
<meta name="keywords" content="<?php echo hc(Core::$META['keywords']); ?>">
<link href="/skins/<?php echo Core::$SKIN;?>/css/style.css" rel="stylesheet" type="text/css">
<?php if(count(Core::$CSS)) {echo implode("\n",Core::$CSS);} ?>
<?php if(count(Core::$JS)) {echo implode("\n",Core::$JS);} ?>
</head>

<body>
<div class="body" style="text-align: center; margin:auto;">
<div class="inbody" style="position:relative">
<header style="width:1000px;">
  <div style="text-align:justify">
    <div style="float:left; width:250px; text-align:center;">
      <a href="/"><img src="/skins/default/img/logo.png" alt=""></a>
    </div>
    <div style="float:left; width:750px;">
        <nav>
          <div class="menu">
              <a href="/">Главная</a>
              <a href="/404">404</a>
              <a href="/programs">Калькулятор</a>
              <a href="/cab/registration">Регистрация</a>
              <a href="/news">Новости</a>
              <a href="/aboutus">О нас</a>
            <div style="clear:both;"></div>
          </div>
        </nav>
    </div>
    <div style="clear:both;"></div>
  
  </div>
</header>
<hr>
<div style="width:1000px; margin:0px auto;">
  <div style="width:1000px; padding-left:30px; padding-right:30px;">
    <article class="result les_body">
      <?php echo $content; ?>
    </article>
  </div>
</div>






<footer>
  <div class="header_line1">
    <div class="header_line2" style="padding-top:20px;">
      <img src="/skins/default/img/skype.gif" alt="" width="16" height="12"> imbalance_hero | 
      <img src="/skins/default/img/mail.png" alt="" width="16" height="12"> <a href="mailto:inpost@list.ru">inpost@list.ru</a>
    </div>
  </div>
  <div style="width:204px; margin:auto;">
  <div>Page Load: <?php echo microtime(true) - $t; ?></div>
</div>
</footer>
</div>
</div>


</body>

</html>