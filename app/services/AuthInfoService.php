<?php

namespace app\services;

class AuthInfoService
{
    public static function isAuth()
    {
        return isset($_SESSION['auth']);
    } 
    
    public static function auth()
    {
        return (self::isAuth()) ? $_SESSION['auth'] : null;
    }
}
