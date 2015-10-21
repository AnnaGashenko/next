function hideShow(id) {
	x = document.getElementById(id);

	if(x.style.display == 'block') {
		x.style.display = 'none';
	} else {
		x.style.display = 'block';
	}
	

}

x = 0;
function test() {
	++x;
	console.log('lalala' + x);
	if(x == 5) {
		clearInterval(intervalId);
	}
}

/*
intervalId = setInterval(function() {
	test('arg1','arg2'); 
},2000);
//setInterval;
*/
//setTimeout;
//intervalId = setTimeout(test,2000);



