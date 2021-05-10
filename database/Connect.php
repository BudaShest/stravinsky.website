<?php


namespace database;
use PDO;

//Класс, реализующий подключение к базе данных
class Connect
{
    public static function makeConn(array $connection):PDO
    {
        return new PDO(
            "mysql:host={$connection['host']};dbname={$connection['dbname']};charset=UTF8",
            $connection['login'], $connection['password'],$connection['options']
        );
    }
}