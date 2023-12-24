<?php

use app\core\Router;

require '../vendor/autoload.php';

session_start();
// session_destroy();
// die();

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,2));
$dotenv->load();

$route = new Router;