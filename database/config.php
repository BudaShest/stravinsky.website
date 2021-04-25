<?php
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