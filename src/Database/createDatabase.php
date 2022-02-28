<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Database;
use App\Server\Env;
use Symfony\Component\Dotenv\Dotenv;

$env = new Env();

try {
    if (file_exists(__DIR__ . '/p5_blog_php.sql')) {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env.local');

        $host = $env->get('DATABASE_HOST');
        $db_name = $env->get('DATABASE_NAME');
        $user = $env->get('DATABASE_USER');
        $password = $env->get('DATABASE_PASSWORD');
        if (! is_string($host) || ! is_string($user) || ! is_string($password) || ! is_string($db_name)) {
            throw new PDOException('Les informations de connexion à la base de données ne sont pas au bon format');
        }

        // creation of database
        $db = new PDO(sprintf('mysql:host=%s', $host), $user, $password);
        $db->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s;', $db_name)) || die(print_r($db->errorInfo(), true));

        // creation of tables
        $database = new Database();
        $pdo = $database->getPDO();

        $pdo->exec((string) file_get_contents(__DIR__ . '/p5_blog_php.sql'));
        echo 'Base de données et tables créées';
    }
} catch (PDOException $e) {
    die('DB ERROR: ' . $e->getMessage());
}
