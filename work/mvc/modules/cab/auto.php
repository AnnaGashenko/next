<?php
if(isset($_POST['login'],$_POST['password'])){
    $res=q("SELECT * FROM `users` WHERE
        `login`='".$_POST['login']."' 
        AND `password`='".myHash($_POST['password'])."' 
        AND `active`=1
        LIMIT 1");
    if ($res->num_rows){
        $_SESSION['user']=$res->fetch_assoc();
        $status="OK";
      
        if(isset($_POST['memo'])){
            setcookie("id", $_SESSION['user']['id'],time()+43200, "/");
            setcookie("hash", myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email']),time()+43200, "/");
 
            q("UPDATE `users` SET `hash`='".myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email'])."', `ip`='".$_SERVER['REMOTE_ADDR']."', `Browser`='".$_SERVER['HTTP_USER_AGENT']."' WHERE `id`='".$_SESSION['user']['id']."'");
        }
        
        header('Location: /');
    } else {
        $error='Нет пользователя с таким логином или паролем';
    }

	DB::close();
}
