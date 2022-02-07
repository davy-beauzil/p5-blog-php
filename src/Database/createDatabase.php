<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use App\Database\Database;

try {
    if(file_exists(__DIR__ . '/p5_blog_php.sql')){
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env.local');

        // creation of database
        $db = new PDO(sprintf('mysql:host=%s', $_ENV['DATABASE_HOST']), $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
        $db->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s;', $_ENV['DATABASE_NAME'])) or die(print_r($db->errorInfo(), true));

        // creation of tables
        $database = new Database();
        $pdo = $database->getPDO();

        $pdo->exec((string) file_get_contents(__DIR__ . '/p5_blog_php.sql'));
        echo 'Base de données et tables créées';
    }
}
catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}