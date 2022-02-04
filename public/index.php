<?php

require_once '../vendor/autoload.php';

use App\Router\Router;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');



$router = new Router();
$router->routing($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


