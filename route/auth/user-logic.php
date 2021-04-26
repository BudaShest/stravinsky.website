<?php
session_start();
use app\Validate;
require $_SERVER['DOCUMENT_ROOT'] ."/bootstrap.php";


//TODO вынести вот это иф в функцию, т.к авторизация повторяется
if(isset($_POST['log_submit_btn'])){
    $login = Validate::validateString($_POST['auth_login']);
    $password = Validate::validateString($_POST['auth_password']);
    if($stmt = $dataUser->searchRecord($login)){
        if(password_verify($password, $stmt->password)){
            $_SESSION['auth_user_id'] = $stmt->id;
            header('Location:/');
        }else{
            $_SESSION['auth_error'] = "Неправильный пароль";
            header('Location: /route/auth/index.php');
        }
    }else{
        $_SESSION['auth_error'] = "Нет такого пользователя";
        header('Location: /route/auth/index.php');
    }


}
if(isset($_POST['reg_submit_btn'])){

    $login = Validate::validateString($_POST['user_login']);
    $email = Validate::validateString($_POST['user_email']);
    $password = Validate::validateString(password_hash($_POST['user_password'], PASSWORD_DEFAULT));
    $image = $fileWorker->uploadOneImg($_FILES['user_img'],"user-data");

    $emailCode = $_POST['user_email_code'];
    $emailCodeConfirm = $_POST['user_email_code_confirm'];

    if(!in_array($login, $dataUser->getAllNames())){
        if(!in_array($email, $dataUser->getAllEmails())){
            if(true){ //TODO $emailCode === $emailCodeConfirm - вот такое условие
                $dataUser->insertRecord($login,$email,$password,$image);
                header('Location:/');
            }
            //TODO если заработает подтверждение по почте, вернуть
//            else{
//                $_SESSION['reg_error'] = "Не совпал код подтверждения! Попробуйтн ещё раз";
//                header('Location:/route/auth');
//            }
        }else{
            $_SESSION['reg_error'] = "Пользователь с такой почтой уже есть";
            header('Location:/route/auth');
        }

    }else{
        $_SESSION['reg_error'] = "Пользователь с таким логином уже есть";
        header('Location:/route/auth');
    }



}

if(isset($_GET['btn_logout'])){
    unset($_SESSION["auth_user_id"]);
    session_destroy();
    header('Location: /route/auth/index.php');
}

if(isset($_GET['btn_basket'])){
    header('Location: /route/basket');
}

if(isset($_GET['btn_applications'])){
    header('Location: /route/applications');
}
