// JavaScript Document

function htmlspecialchars(str) {
	if (typeof(str) == "string") {
		str = str.replace(/&/g, "&amp;"); /* must do &amp; first */
		str = str.replace(/"/g, "\"");
		str = str.replace(/'/g, "&#039;");
		str = str.replace(/</g, "&lt;");
		str = str.replace(/>/g, "&gt;");
	}
	return str;
}

window.onload = function() {
	$("#reviews_form").submit(function(){	
		
		// Variables
		var reviews_text = $('#reviews_text').val();
		var reviews_form = $('#reviews_form');
		
		// Если поля логин или пароль не заполнены
		if(reviews_text.length < 1) {
			$('#text_error').text('Вы не заполнили поле с комментарием').css('display','block');
			$("#reviews_text").css('border','1px solid #F00');
		// если все в порядке отправляем запрос на сервер
		} else {
			$("#reviews_text").css('border','1px solid #ddd');
			$('#text_error').css('display','none');
			$.ajax({
				url: '/reviews/add',
				type: "POST",
				cache: false,
				// какие данные мы передаем на сервер
				data: {
					reviews_text: reviews_text
				},
				success: function(msg) {
					var response = JSON.parse(msg);
					// Объекты в цикле jQuery $.each:
	                $.each(response, function(){
	                	var reviews_text = this.reviews_text;
	                	reviews_text = htmlspecialchars(reviews_text);
	                	$('.comments').prepend('<div class="comment_block" id="'+this.id+'"><div class="comment_title"> - '+this.reviews_login+'<span class="comment_date"> '+this.date+'</span></div><div class="comment_body">'+reviews_text+'</div></div>');
                		$('.comment_block:last').remove();
				    });
				    $(".add_comment").before('<div class="infoBox">Комментарий был успешно добавлен</div>');
					$('.infoBox').css({
						'font-size' : '14px',
						'color': '#269e94',
						'font-weight': 'bold',
						'height': '20px',
						'margin' : '20px 47px 20px 0'
					});
					$('.infoBox').fadeOut(6000);
					document.forms.reviews_form.reset();
				}	
				
								
			});
		}
		return false;
	});
};// window.onload






























