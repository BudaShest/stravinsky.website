<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

//Авторизация в админ-панель
if(isset($_POST['btn_submit'])){
    $login = htmlentities($_POST['admin_login']);
    $password = htmlentities($_POST['admin_password']);
    if($stmt = $dataUser->searchRecord($login)){
        if(password_verify($password, $stmt->password) && $stmt->role_id == 1){
            $_SESSION["is_admin_auth"] = True;
            header('Location:/route/admin/admin-data.php');
        }else{
            $_SESSION['admin_auth_error'] = 'Вы не админ!';
            header('Location: /route/admin');
        }
    }else{
        $_SESSION['admin_auth_error'] = 'Вы не админ!';
        header('Location:/route/admin');
    }
}
