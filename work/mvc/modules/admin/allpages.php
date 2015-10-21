<?php

if(!isset($_SESSION['user']) || $_SESSION['user']['rights'] != 5) {
	if($_GET['module'] != 'static' || $_GET['page'] != 'main') {
		header("Location: /admin/static/main");
		exit();
	}
}
