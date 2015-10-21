<script type="text/javascript" src="/skins/<?php echo Core::$SKIN; ?>/js/reviews.js"></script>
<div class="comments">
  <h1>ОТЗЫВЫ</h1>
	<?php
	if(mysqli_num_rows($result)){
		echo '<div id="count_comment"> Комментарии на странице: ('.$total.')</div>';
		$i = 0;
		while($row = $result->fetch_assoc()) {			
			echo '<div class="comment_block">
			        <div class="comment_title"> - '.htmlspecialchars($row['reviews_login']),
				     '<span class="comment_date">  '.htmlspecialchars($row['date']), 
				     '</span></div>',
				   '<div class="comment_body">  '.nl2br(htmlspecialchars($row['reviews_text'])), '</div>
				 </div>';
			$i++;
			// Записываем id последнего комментария в сессию
			// Чтобы не затиралась запись в сессии останавливаем цикл после первого прохода
			if($i > 1) {
				continue;
			}
			$id = $row['id'];
			$_SESSION['id'] = $id;
		}
		
	} else{ echo 'Нет записей';} ?>
        
    <div class="paginator">
	  <?php 
		// вывод постраничной навигации
        Paginator::showPaginator(); 
      ?> 
    </div>   
  <div class="add_comment">
  <!--Если пользователь не зарегестрировался выводим форму-->
  <?php if(!isset($_SESSION['user'])) {
	  	  echo 'Комментарии могут оставлять только авторизированные пользователи';
        } else { 
			if(!isset($_SESSION['regok'])){ ?>
			  <form action="/reviews" method="post" id="reviews_form" name="reviews_form">
				<table border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="100"><span class="comments_title">Логин *</span></td>
					<!--Чтобы не стиралась инфа которую заполнил пользователь, записываем ее в value-->
					<td><input name="reviews_login" type="text" id="reviews_login" value="<?php echo $_SESSION['user']['login']; ?>"></td>
					<td><span class="comments_error" id="login_error"><?php echo @$errors['reviews_login']; ?></span></td>
				  </tr>
				  <tr>
					<td height="30"><span class="comments_title">E-mail *</span></td>
					<td><input name="reviews_email" type="text"  id="reviews_email" value="<?php echo $_SESSION['user']['email']; ?>"></td>
					<td><span class="comments_error" id="email_error"><?php echo @$errors['reviews_email']; ?></span></td>
				  </tr>
				  <tr>
					<td colspan="2">
					<span class="comments_title">Введите комментарий: *</span><br>
					<textarea name="reviews_text"  id="reviews_text" value="<?php echo @htmlspecialchars($_POST['reviews_text']); ?>"></textarea></td>
					<td style="vertical-align:middle"><span class="comments_error"><?php echo @$errors['reviews_text']; ?></span></td>
				  </tr>
				</table>
				<p style="font-size:10px">* - обязательные для заполнения</p>
				<input type="submit" name="submit" value="Отправить комментарий">
			  </form>
		  <!--Иначе, если пользователь  зарегестрировался выводим сообщение и делаем переадресацию-->
  	<?php   } else { 
	          /*Удаляем сесию после переадресации и снова выводится форма*/
	          unset($_SESSION['regok']); ?>
  		  	  <div id="mess"></div>
    <?php   }
	    }?>

  </div>
  
</div>

