<?php

require_once '../vendor/autoload.php';

use App\Router\Router;
use App\Server\Server;
use Symfony\Component\Dotenv\Dotenv;

// session duration : 1 hour/3600   1 minut/60
ini_set('session.gc_maxlifetime', 10);
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');

$server = new Server();
$router = new Router();
$router->routing($server->get('REQUEST_URI'), $server->get('REQUEST_METHOD'));


