<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

//TODO вынести вот это иф в функцию, т.к авторизация повторяется
if(isset($_POST['btn_submit'])){
    $login = htmlentities($_POST['admin_login']);
    $password = htmlentities($_POST['admin_password']);
    if($stmt = $dataUser->searchRecord($login)){
        if(password_verify($password, $stmt->password)){
            $_SESSION["is_admin_auth"] = True;
            header('Location:/route/admin/admin-data.php');
        }else{
            $_SESSION['admin_auth_error'] = 'Неправильный пароль!';
            header('Location: /route/admin');
        }
    }else{
        $_SESSION['admin_auth_error'] = 'Вы не админ!';
        header('Location:/route/admin');
    }
}
