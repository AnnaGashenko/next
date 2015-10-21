<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo hc(Core::$META['title']); ?></title>
<meta name="description" content="<?php echo hc(Core::$META['description']); ?>">
<meta name="keywords" content="<?php echo hc(Core::$META['keywords']); ?>">
<link href="/skins/default/css/style.css" rel="stylesheet" type="text/css">
<?php if(count(Core::$CSS)) {echo implode("\n",Core::$CSS);} ?>
<?php if(count(Core::$JS)) {echo implode("\n",Core::$JS);} ?>
</head>

<body>
<div class="body" style="text-align: center; margin:auto;">
<div class="inbody" style="position:relative">
<header style="width:1000px;">
  <div style="text-align:justify">
    <div style="float:left; width:250px; text-align:center; color:#900; font-weight:bold; font-size:20px;">
      !!!АДМИНКА!!!
    </div>
    <div style="float:left; width:750px;">
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['rights'] == 5) { ?>
        <nav>
          <div class="menu">
              <a href="/admin">Главная</a>
              <a href="/admin/news">Новости</a>
            <div style="clear:both;"></div>
          </div>
        </nav>
    <?php } ?>
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