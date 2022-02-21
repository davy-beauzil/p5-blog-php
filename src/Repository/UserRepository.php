<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Login;
use App\Exception\LoginException;
use App\Exception\RegisterException;
use App\Model\User;
use function count;
use function is_string;
use PDOException;

class UserRepository extends AbstractRepository
{
    public static function create(User $register): void
    {
        if (self::userExists($register->email)) {
            throw new RegisterException('Vous avez déjà un compte. Essayez de vous connecter.');
        }

        $pdo = self::getPDO();
        $sql = 'INSERT INTO users (first_name, last_name, email, password, is_author, is_admin, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, :is_author, :is_admin, :created_at, :updated_at);';
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'first_name' => $register->first_name,
                'last_name' => $register->last_name,
                'email' => $register->email,
                'password' => $register->password,
                'is_author' => 0,
                'is_admin' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ]);
            if (! self::userExists($register->email)) { // @phpstan-ignore-line
                throw new RegisterException(
                    'Une erreur s’est produite lors de la création de votre compte. Veuillez réessayer ultérieurement.'
                );
            }
        } catch (PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }
    }

    public static function userExists(string $email): bool
    {
        $pdo = self::getPDO();
        $sql = 'SELECT email FROM users WHERE email = :email;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
        ]);
        $result = $stmt->fetchAll();

        return $result !== false && count($result) >= 1;
    }

    /**
     * @return array<string, mixed>
     */
    public static function connectByEmail(Login $login): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $login->email,
        ]);
        /** @var array<string, mixed> $user */
        $user = $stmt->fetch();

        if ($user['id'] !== null && isset($user['password']) && is_string($user['password'])) {
            if (! password_verify($login->password, $user['password'])) {
                throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
            }
            unset($user['password']); // On supprime le mot de passe car l'objet $user sera dans la session

            return $user;
        }
        throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
    }
}
