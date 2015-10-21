// JavaScript Document

$(document).ready(function() {
	$('.block_right .login').click(function() {
		$('#modal_window').toggle(500);
		return false;
	});
	
	$("#authorization").submit(function(){
		// Получаем занчение полей логин и пароль
		var login = $("#auth_login").val();
		var pass = $("#auth_pass").val();
		if($('#auth_check').is(':checked')) {
			var check = ($(this).attr('name'));
		} 
		// Если поля логин или пароль не заполнены
		if(login == '' || pass == '') {
			if(login == "") {
			  $("#auth_login").css('border','1px solid #F00');
			} else {
			  $("#auth_login").css('border','1px solid green');
			}
			if (pass == "") {
			  $("#auth_pass").css('border','1px solid #F00');
			} else {
			  $("#auth_pass").css('border','1px solid green');
			}
		// если все в порядке отправляем запрос на сервер
		} else {
			$("#auth_login, #auth_pass").css('border','1px solid green');
			$.ajax({
				url: '/cab/auth',
				type: "POST",
				cache: false,
				// какие данные мы передаем на сервер
				data: {
					login: login,
					pass: pass,
					check: check
				},
				success: function(msg) {
					if(msg == 'no') {					
						$('#errors').text('Нет пользователя с таким логином и паролем').css('display','block');
					} else {
						var path = window.location.href;
						window.location.href = path;
					}
				}
			});
		}
		return false;
	});	
});// конец ready






























