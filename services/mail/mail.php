<?php

function sendMail(string $to, string $subject, string $message){

    $from = "rsx99@mail.ru";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: <".$from.">\r\n";

    if (mail($to,$subject,$message,$headers)) {
        return true;
    }
    else {
        return false;
    }
}
