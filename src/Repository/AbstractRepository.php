<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Database;
use PDO;

class AbstractRepository
{
    public static ?PDO $pdo = null;

    public static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getPDO();
        }

        return self::$pdo;
    }
}
