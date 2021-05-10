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
//   'host'=>'localhost',
//   'dbname'=>'u1363425_stravinsky',
//   'login'=>'u1363425_joshua',
//   'password'=>'FuckBrutForce557',
//   'options'=>[
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
//   ]
//];