<?php
//Настройки для локалььного сервера
const CONNECTION = [
    'host'=>'localhost',
    'dbname'=>'stravinsky',
    'login'=>'mysql',
    'password'=>'mysql',
    'options'=>[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
];

//Настройки для удалённого сервера
//const CONNECTION = [
//    'host'=>'localhost',
//    'dbname'=>'u1363425_default',
//    'login'=>'u1363425_default',
//    'password'=>'u7I6pupkKS18xJ7Z',
//    'options'=>[
//        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
//    ]
//];