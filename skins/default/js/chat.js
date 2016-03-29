// JavaScript Document
$(document).ready(function() {
	// прикручиваем полосу прокрутки к низу, чтобы видеть последние сообщения
	$('#all-mess').scrollTop($('#all-mess').prop('scrollHeight'));	

	// Каждые 4 секунды проверяем нет ли новых сообщений
	setInterval(function(){
		showMess();
	},4000);


	// кликая по имени собеседника, вставляем его логин в поле ввода сообщения
	$(".comment_name").click(function(){
		var comment_name = $(this).text();
		$("#chat_message").val(comment_name+', ').focus();
	})

	$("#chat_form").submit(function(){	
		// Проверяем на корректность текст
		var chat_message = $('#chat_message').val().replace(/<\/?[^>]+>/g,''); 
		var chat_form = $('#chat_form');
		
		// Проаеряем заполнено ли поле ввода сообщения
		if(chat_message.length < 1) {
			$('.text_error').text('Вы не ввели сообщение').css({'display':'block','color' : '#F00','padding':'10px'});

		// если все в порядке отправляем запрос на сервер
		} else {
			$('.text_error').css('display','none');
			$.ajax({
				url: '/chat/mess-add',
				type: "POST",
				cache: false,
				// какие данные мы передаем на сервер
				data: {
					chat_message: chat_message
				},
				success: function(msg) {
					// очищаем поле ввода после отправки сообщения
					document.forms.chat_form.reset();
					// выводим сообщение 
					showMess();
					
				}									
			});
		}
		return false;
	});
});// конец ready

	// Функция добавляет новые сообщения в чат 
	function showMess(){
		$.ajax({
			url: '/chat/DisplayMessages',
			type: "POST",
			cache: false,
			success: function(msg) {
				var response = JSON.parse(msg);
				for (var i in response.newOnline) {
					$('#chat ul').prepend('<li class="comment_name">'+response.newOnline[i].user_login+'</li>');
				}
/*
				for (var i in response.countOnline) {
					$('.countOnline').text(response.countOnline);
				}
*/
				for (var i in response.newMess) {
                	$('#all-mess').append('<div class="comment_block" id="'+response.newMess[i].id+'"><div class="comment_title"> - <span class="comment_name">'+response.newMess[i].ChatUserId+'</span><span class="comment_date"> '+response.newMess[i].date+'</span></div><div class="comment_body">'+response.newMess[i].chat_message+'</div></div>');
				}
			    // прикручиваем полосу прокрутки к низу после добавления нового сообщения
			    $('#all-mess').scrollTop($('#all-mess').prop('scrollHeight'));			
			}													
		});
	}



/*	
# Функция 
	function selectedText() { 
	  		if(window.getSelection)
			txt = window.getSelection().toString();
			else if(document.getSelection)
			txt = document.getSelection();                
			else if(document.selection)
			txt = document.selection.createRange().text;
			return txt;
			//alert (txt);
		
	}
*/



























