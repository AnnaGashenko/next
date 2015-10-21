// JavaScript Document

window.onload = function() {
	$("#reviews_form").submit(function(){		
		
		// Проверяем на корректность логин
		var reviews_login = $('#reviews_login').val();	
		var regL = /^([a-z]+\d*[\_\-]*[a-z]*)$/ig;
		var resultLogin = reviews_login.match(regL); // записываем найденное совпадение в результат
		
		// Проверяем на корректность емейла
		var reviews_email = $('#reviews_email').val();	
		var regV = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/g;
		var result = reviews_email.match(regV); // записываем найденное совпадение в результат
		
		// Записываем id последнего сообщения
		var reviews_text = $('#reviews_text').val().replace(/<\/?[^>]+>/g,'');
		var reviews_form = $('#reviews_form');
		
		// Если поля логин или пароль не заполнены
		if(reviews_login == '' ||  reviews_text == '' || reviews_email == '' || !result || !resultLogin) {
			if(!result || reviews_email == "") {
				$('#email_error').text('Вы ввели не корректный email').css('display','block');
				$('#reviews_email').css('border','1px solid #F00');
			} else {
				$('#email_error').css('display','none');
				$("#reviews_email").css('border','1px solid green');
			}
			if(reviews_login == "" || !resultLogin) {
			  $('#login_error').text('Вы ввели не корректный логин').css('display','block');
			  $("#reviews_login").css('border','1px solid #F00');
			} else {
			  $("#reviews_login").css('border','1px solid green');
			  $('#login_error').css('display','none');
			}
			if (reviews_text == "") {
			  $("#reviews_text").css('border','1px solid #F00');
			} else {
			  $("#reviews_text").css('border','1px solid green');
			}
		// если все в порядке отправляем запрос на сервер
		} else {
			$("#reviews_login, #reviews_email, #reviews_text").css('border','1px solid #ddd');
			$('#email_error').css('display','none');
			$.ajax({
				url: '/reviews',
				type: "POST",
				cache: false,
				// какие данные мы передаем на сервер
				data: {
					reviews_login: reviews_login,
					reviews_email: reviews_email,
					reviews_text: reviews_text
				},
				success: function(msg) {
					$('#count_comment').after('<div class="comment_block"><div class="comment_title"> - '+reviews_login+'<span class="comment_date"> '+msg+'</span></div><div class="comment_body"><pre>'+reviews_text+'</pre></div></div');
					document.forms.reviews_form.reset();
				}
				
			});
		}
		return false;
	});
};// window.onload






























