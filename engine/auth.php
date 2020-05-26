<?php

function auth($login,$pass) {
    global $db;
    //Запрос от БД на существование такого юзера
    $user = getArray($db,"SELECT * FROM `users` WHERE `login` = '{$login}'")[0];
    if (password_verify($pass,$user['pass'])) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $user['id'];
    }
    return password_verify($pass,$user['pass']);
}

if (!empty($_POST)) {
    $login = safeData($db,$_POST['login']);
    $pass = safeData($db,$_POST['pass']);
    $params['isAuthorised'] = auth($login,$pass);
    if (auth($login,$pass)) {
        if (isset($_POST['save'])) {
            $hash = uniqid('',true);
            $id = $_SESSION['id'];
            updateRow($db,'users',"id={$id}","'hash={$hash}");
            setcookie('hash',$hash,time()+3600,'/');
        }
    } else {
        Die('login failed');
    }
}
$params['login'] = $_SESSION['login'];
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("Location: /?page=test");
}