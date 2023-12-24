<?php

namespace app\core;

use app\services\AuthInfoService;
use app\services\AuthService;
use app\services\CartInfoService;
use League\Plates\Engine;
use Exception;

class View
{
    private static array $instances = [];

    private static function addInstances($instanceskey, $instanceClass)
    {
        if(!isset(self::$instances[$instanceskey])){
            self::$instances[$instanceskey] = $instanceClass;
        }
    }
    
    public static function  render(string $view, array $data = [])
    {
        $path = dirname(__FILE__, 3);
        $filePath = $path . DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;

        if(!file_exists($filePath . $view . '.php')){
            var_dump('not exists');
            throw new Exception("View {$view} does not exists");            
        }

        self::addInstances('cart', CartInfoService::class);
        self::addInstances('auth', AuthInfoService::class);


        $templates = new Engine($filePath);
        $templates->addData(['instances' => self::$instances]);
        echo $templates->render($view, $data);
    }
}