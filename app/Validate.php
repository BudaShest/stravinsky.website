<?php


namespace app;

//Данный класс реализует валидацию некоторых полей форм
class Validate
{

    public static function validateString(string $string){
        return htmlentities(trim($string));
    }

    public static function validateLogin(string $login)
    {
        $loginOutPut = self::validateString($login);
        if(preg_match("/[а-я]|[А-Я]|[\!-\/]|[\[-`]]/", $loginOutPut)){
            return false;
        }else if(strlen($loginOutPut) < 4 || strlen($loginOutPut) > 11){
            return false;
        }
        return $loginOutPut;
    }

    public static function validateEmail(string $email){
        $emailOutPut = self::validateString($email);
        if(preg_match('/@/',$emailOutPut) && preg_match('/[а-я]|[А-Я]/',$emailOutPut)==false){
            return $emailOutPut;
        }else{
            return false;
        }
    }

    public static function validatePassword(string $password){
        $passwordOutPut = self::validateString($password);
        $uppercase = preg_match('/[A-Z]/', $passwordOutPut);
        $lowercase = preg_match('/[a-z]/', $passwordOutPut);
        $number = preg_match('/[0-9]/', $passwordOutPut);
        $latin = preg_match('/[а-я]|[А-Я]/',$passwordOutPut);
        if(!$uppercase || !$lowercase ||!$number ||strlen($password) < 8)
        {
            return false;
        }else{
            if($latin==false){
                return $passwordOutPut;
            }
            return false;
        }
    }
}