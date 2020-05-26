<?php

function auth($login,$pass) {
    global $db;
    //Запрос от БД на существование такого юзера
    $user = getArray($db,"SELECT * FROM `users` WHERE `login` = '{$login}'")[0];
    if (password_verify($pass,$user['pass'])) {
        $_SESSION['login'] = $login;
    }
    return password_verify($pass,$user['pass']);
}

if (!empty($_POST)) {
    $login = safeData($db,$_POST['login']);
    $pass = safeData($db,$_POST['pass']);
}
if ($params['isAuthorised'] = auth($login,$pass)) {
    if ()
} else {
    Die('login failed');
}
$params['login'] = $_SESSION['login'];
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("Location: /?page=test");
}