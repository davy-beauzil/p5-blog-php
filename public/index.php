<?php

require_once '../vendor/autoload.php';

use App\Router\Router;
use App\Server\Server;
use App\Server\Env;
use Symfony\Component\Dotenv\Dotenv;


$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');

if(Env::get('ENV') === 'dev'){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$server = new Server();
$router = new Router();
$router->routing($server->get('REQUEST_URI'), $server->get('REQUEST_METHOD'));


