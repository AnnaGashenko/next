<!--Чтобы лучше тестировать работу скрипта, установим таймер для обновления версии с каждой перезагрузкой страницы-->
<script type="text/javascript" src="/skins/<?php echo Core::$SKIN; ?>/js/reviews.js?t=<?php echo time(); ?>"></script> 
<div class="reviews">ОТЗЫВЫ</div>
<div class="comments"> 
	<?php if(mysqli_num_rows($result)){

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
			$_SESSION['id'] = $row['id'];
		}
		
	} else { 
		echo 'Нет записей';
	} ?>
        
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
			<form action="" method="post" id="reviews_form" name="reviews_form">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2">
						<span class="comments_title">Введите комментарий: *</span><br>
						<textarea name="reviews_text"  id="reviews_text"></textarea></td>
						<td style="vertical-align:middle"><span class="comments_error" id="text_error"><?php echo @$errors['reviews_text']; ?></span></td>
					</tr>
				</table>
				<p style="font-size:10px">* - обязательные для заполнения</p>
				<input type="submit" name="submit" value="Отправить комментарий">
			</form>
		<!--Иначе, если пользователь  зарегестрировался выводим сообщение и делаем переадресацию-->
	  	<?php } else { 
	        /* Удаляем сесию после переадресации и снова выводится форма */
	        unset($_SESSION['regok']); ?>
			<div id="mess"></div>
	    <?php } ?>
	
	<?php } ?>
	</div> <!-- /.add_comment --> 
</div> <!-- /.comments --> 


