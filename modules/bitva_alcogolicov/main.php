<?php
if(isset($_POST['submit'])) { 
	if(!isset($_SESSION['client'], $_SESSION['server'])){
		$_SESSION['client'] = 10;
		$_SESSION['server'] = 10;
		
	}
	if(rand(1,3) == $_POST['number']){
		$_SESSION['client'] = $_SESSION['client'] - rand(1,4);
	}
	else{
		$_SESSION['server'] = $_SESSION['server'] - rand(1,4);
	}
	if($_SESSION['client'] <= 0){
		header("Location: /index.php?module=bitva_alcogolicov&page=gameover_client");
		exit();
	}
	elseif($_SESSION['server'] <= 0){
		header("Location: /index.php?module=bitva_alcogolicov&page=gameover_server");
		exit();
	}

}
?>

