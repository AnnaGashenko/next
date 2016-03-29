<!--Чтобы лучше тестировать работу скрипта, установим таймер для обновления версии с каждой перезагрузкой страницы-->
<script type="text/javascript" src="/skins/<?php echo Core::$SKIN; ?>/js/chat.js?t=<?php echo time(); ?>"></script>

<div id="chat">
	<div id="chat_online">
		<h2>Сейчас онлайн:<span  class="countOnline">  <?php echo $count ?> </span> человек(а)</h2>
		<ul>
		<?php if(mysqli_num_rows($res_online)){
			while($row_online = $res_online->fetch_assoc()) {	
				echo '<li class="comment_name">'.$row_online['user_login'].'</li>';
			}
		} ?>
		</ul>
	</div>

	<div id="chat-mess">

		<!-- Выводим все сообщения -->
		<div id="all-mess">
			<?php if(mysqli_num_rows($result)){
				while($row = $result->fetch_assoc()) {	
					echo '<div class="comment_block" id="'.$row['id'].'">
					        <div class="comment_title"> - <span class="comment_name">'.htmlspecialchars($row['ChatUserId']),
						     '</span><span class="comment_date">  '.htmlspecialchars($row['date']), 
						     '</span></div>',
						   '<div class="comment_body">  '.nl2br(htmlspecialchars($row['chat_message'])), '</div>
						 </div>';					
				}
			} else { 
				echo 'Нет записей';
			} ?>
		</div>

    <!--Если пользователь не авторизировался выводим сообщения-->
    <?php if(!isset($_SESSION['user'])) { ?>
		<div class="chat_auth"><?php echo 'Для вступления в диалог вам необходимо авторизоваться';?></div>
     <?php } else { ?>
		<!-- Если пользователь авторизирован выводим форму -->
		<div id="chat_send_form">
			<form action="mess-add" method="post" id="chat_form" >
				<textarea id="chat_message" name="chat_message" class="message-send" placeholder="Напишите Ваше сообщение"></textarea>
				<div class="text_error"><?php echo @$errors['chat-error']; ?></div>
				<div class="input-group">
					<!--<div class="chat-btn-add smile">:)</div>-->
					<!--<div class="chat-btn-add bold"><b>[B]</b></div>-->
					<!--<div class="chat-btn-add italic"><i>[I]</i></div>-->
					<input type="submit" name="submit" class="chat-btn-add chat-btn-send" value="Отправить">
				</div>
			</form>
		</div>	
		<div id="mess"></div>	
	<?php } ?>
	</div>
</div>