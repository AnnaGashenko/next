// JavaScript Document
$(document).ready(function() {

	// Каждые 5 секунды проверяем нет ли новых заказов
	setInterval(function(){
	    lastChange();
	},5000);

	// внешняя переменная 
	num;
	function lastChange(){
		$.ajax({
			url: '/restaurant/DisplayOrders',
			type: "POST",
			cache: false,
			success: function(msg) {
				var response = JSON.parse(msg);		
				var count = 0;		
				for (var i in response.newOrder) {	
					count++;
					$('.lastOrders').prepend('<tr><td><a href="/restaurant/dishes2order?id='+response.newOrder[i].id+'">'+response.newOrder[i].id+'</a></td><td>'+response.newOrder[i].weiter_name+'</td><td>'+response.newOrder[i].date+'</td><td>'+response.newOrder[i].summ_order+'</td></tr>');					
				}
				num = num + count;
				var countDelete = num - 5 ;
				if (countDelete > 0) {
					var i = 0;
					while(i < countDelete){					
						// так удаляет нужное количество
						$('.lastOrders tr:last').remove();
						i++;
					}
					num = 5;
				}

				for (var i in response.newSumm) {
					$(".summaForDay").text(response.newSumm[i].OrderTotal);
					$(".noOrders").css('display','none')
				}
				for (var i in response.popularDishes) {
			            	$('.popular5dishes').prepend('<tr><td>'+response.popularDishes[i].id+'</td><td>'+response.popularDishes[i].title_dish+'</td><td>'+response.popularDishes[i].price+'</td></tr>');
			            	$('.popular5dishes tr:last').remove();
				}
			}													
		});
	}

});// конец ready
