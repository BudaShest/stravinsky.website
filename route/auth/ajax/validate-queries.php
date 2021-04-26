<?php
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
use app\Validate;

if(isset($_POST['register-login'])){
    $login = Validate::validateLogin($_POST['register-login']);
    if(is_string($login)){
        echo json_encode($login);
    }else{
        echo json_encode([
            'error'=>'В логине не должно быть кириллицы, он должен содержать от 4 до 11 символов!'
        ]);
//        echo json_encode('В логине не должно быть кириллицы, он должен содержать от 4 до 11 символов!');
    }
}

if(isset($_POST['register-password'])){
    $password = Validate::validatePassword($_POST['register-password']);
    if(is_string($password)){
        echo json_encode($password);
    }else{
        echo json_encode([
            'error'=>'Пароль должен содержать хотя бы одну заглавную латинскую букву и цифру!'
        ]);
//        echo json_encode('Пароль должен содержать хотя бы одну заглавную латинскую букву и цифру!');
    }
}

if(isset($_POST['register-email'])){
    $email = Validate::validateEmail($_POST['register-email']);
    if(is_string($email)){
        echo json_encode($email);
    }else{
        echo json_encode([
            'error'=>'Некоректный адресс почты'
        ]);
//        echo json_encode('Некоректный адресс почты');
    }
}