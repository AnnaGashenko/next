<?php 

if (isset($_POST['login'],$_POST['password'],$_POST['email'],$_POST['name'],$_POST['sername'],$_POST['age'])){
    $errors=array();
    if (empty($_POST['login'])){
        $errors['login']="Вы не заполнили поле логин";
    }
    elseif (mb_strlen($_POST['login'])<2){
        $errors['login']="Логин слишком короткий";
    }
    elseif (mb_strlen($_POST['login'])>16){
        $errors['login']="Логин слишком длинный";
    }
    
    if (mb_strlen($_POST['password'])<5){
        $errors['password']="Пароль должен быть длинней 4 символов";
    }
    if (empty($_POST['email'])||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email']="Вы не заполнили поле e-mail или заполнили неправильно";
    }
    if(!count($errors)){
        $res=q("SELECT `id` FROM `users` WHERE
        `login`='".es($_POST['login'])."' LIMIT 1");
        
        if($res->num_rows){
            $errors['login']='Такой логин уже занят';
        }
        $res=q("SELECT `id` FROM `users` WHERE
        `email`='".es($_POST['email'])."' LIMIT 1");
        if($res->num_rows){
            $errors['email']='Такой email уже занят';
        }
    }
    
    if (!count($errors)){
        
        $sql="INSERT INTO `users` SET 
            `name`='".es($_POST['name'])."', 
            `sername`='".es($_POST['sername'])."', 
            `login`='".es($_POST['login'])."', 
            `password`='".myHash($_POST['password'])."', 
            `email`='".es($_POST['email'])."', 
            `age`=".(int)$_POST['age'].",
            `hash`='".myHash($_POST['login'].$_POST['age'])."'";
            
            
        $res=q($sql);
        $id=DB::_()->insert_id;
        
        
        $_SESSION['regok']="OK";
        Mail::$to=$_POST['email'];
        Mail::$subject='Вы зарегистрировались на сайт';
        Mail::$text='
            То перейдите по ссылке для активации Вашего аккаунта: <br>'.Core::$DOMAIN.'index.php?module=cab&page=activate&id='.$id.'&hash='.myHash($_POST['login'].$_POST['age']);
        Mail::Send();
        header("Location: /cab/registration");
        exit();
        
    }
}
