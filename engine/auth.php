<?php
session_start();

//Проверка валидности логин-пароля
function validation($login, $pass) {
    global $db;
    //Запрос от БД на существование такого юзера
    $user = getArray($db,"SELECT * FROM `users` WHERE `login` = '{$login}'")[0];
    if (!empty($user)) {
        if (password_verify($pass,$user['pass'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user['id'];
        } else return new Error('Неверный пароль'); //TODO: описать обработку ошибок
    } else return new Error('Неверный логин');
    return password_verify($pass,$user['pass']);
}
//Проверка авторизован ли уже пользователь
function isAuthorised() {
    if (isset($_COOKIE['hash'])) {
        global $db;
        $hash = $_COOKIE['hash'];
        //Запрос от БД на существование юзера с таким хэшем
        $user = getArray($db,"SELECT * FROM `users` WHERE `hash` = '{$hash}'")[0]['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
        } else {
            setcookie('hash','',time()-3600,'/');
        }
    }
    return isset($_SESSION['login']);
}
//Действия при выходе из учетки
function logout() {
    unset($_COOKIE['hash']);
    setcookie('hash','',time()-3600,'/');
    unset($_SESSION['login']);
    unset($_SESSION['id']);
    header("Location: /?page=test");
}
//Вывод текущего логина
function getLogin() {
    return $_SESSION['login'];
}

if (isAuthorised()) {
    $params['isAuth'] = true;
    $params['login'] = getLogin();
} else {
//Посланы ли данные для авторизации
    if (!empty($_POST)) {
        $login = safeData($db,$_POST['login']);
        $pass = safeData($db,$_POST['pass']);
        if (validation($login,$pass)) {
            if (isset($_POST['save'])) {
                $hash = uniqid('',true);
                $id = $_SESSION['id'];
                updateRow($db,'users',"id={$id}","hash='{$hash}'");
                setcookie('hash',$hash,time()+3600,'/');
            }
            header("Location: /?page=test");
        } else {
            Die('login failed');
        }
    }
}

if (isset($_GET['logout'])) {
    logout();
}