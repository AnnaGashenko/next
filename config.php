<?php

//Создадим класс ЯДРО
class Core {
	static $CREATED  = 2013;
	static $CONT     = 'modules';
	static $SKIN     = 'default';	
	static $DB_NAME  = '';	
	static $DB_LOGIN = '';	
	static $DB_PASS  = '';	
	static $DB_LOCAL = 'localhost';	
	static $DOMAIN   = 'http://next/';
	static $UPLOADER_DIR = '/uploaded/';	
	static $JS   = array(
		'modal_window'=>'modal_window.js',
		'authorization'=>'authorization.js'
	);
	static $CSS  = array();
	static $META = array(
		'title'=>'стандартный TITLE',
		'description'=>'d',
		'keywords'=>'k'
	);

}
// Если нужно вывести нашу переменную echo Core::$SKIN;
