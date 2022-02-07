<?php

declare(strict_types=1);

namespace App\Database;

use App\Server\Env;
use Exception;
use function is_string;
use PDO;

class Database
{
    public ?PDO $pdo = null;

    public function getPDO(): PDO
    {
        $env = new Env();
        $db_name = $env->get('DATABASE_NAME');
        $user = $env->get('DATABASE_USER');
        $password = $env->get('DATABASE_PASSWORD');

        if (! is_string($user) || ! is_string($password) || ! is_string($db_name)) {
            die('Les informations de connexion à la base de données ne sont pas au bon format');
        }

        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO(sprintf(
                    'mysql:host=localhost;dbname=%s;charset=utf8',
                    $db_name
                ), $user, $password);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}
