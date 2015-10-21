<?php
if(isset($_GET['hash'], $_GET['id'])){
    $res=q("UPDATE `users` SET
           `active`=1        
           WHERE hash='".es($_GET['hash'])."'       
           AND id=".$_GET['id']);
    if($res){
		$info='Вы активированны';
    }    
} else {
	$info='Вы прошли по неверной ссылке';
}
