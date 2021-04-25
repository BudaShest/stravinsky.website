<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
$confirmCode = uniqid();

if(sendMail($_POST['mail'],'Подтверждение почты',"Ваш код подтверждения - {$confirmCode}")){
    echo $confirmCode;
}else{

}


