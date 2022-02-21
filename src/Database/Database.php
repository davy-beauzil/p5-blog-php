<?php

declare(strict_types=1);

namespace App\Database;

use App\Server\Env;
use function is_string;
use PDO;
use PDOException;

class Database
{
    public static ?PDO $pdo = null;

    public static function getPDO(): PDO
    {
        $env = new Env();
        $db_name = $env->get('DATABASE_NAME');
        $user = $env->get('DATABASE_USER');
        $password = $env->get('DATABASE_PASSWORD');

        if (! is_string($user) || ! is_string($password) || ! is_string($db_name)) {
            die('Les informations de connexion à la base de données ne sont pas au bon format');
        }

        $options = [
            // désactive le mode d'émulation pour les "vraies" instructions préparées
            PDO::ATTR_EMULATE_PREPARES => false,
            // active les erreurs sous forme d'exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // faire de la récupération par défaut un tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(sprintf(
                    'mysql:host=localhost;dbname=%s;charset=utf8',
                    $db_name
                ), $user, $password, $options);
            } catch (PDOException $e) {
                die('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
