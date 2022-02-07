<?php

require_once '../vendor/autoload.php';

use App\Router\Router;
use App\Server\Server;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');

$server = new Server();
$router = new Router();
$router->routing($server->get('REQUEST_URI'), $server->get('REQUEST_METHOD'));


