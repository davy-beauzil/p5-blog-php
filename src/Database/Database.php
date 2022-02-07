<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    public ?PDO $pdo = null;

    public function getPDO(): PDO
    {
        if($this->pdo === null){
            try{
                $this->pdo = new PDO(sprintf('mysql:host=localhost;dbname=%s;charset=utf8', $_ENV['DATABASE_NAME']), $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
            }catch(\Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}