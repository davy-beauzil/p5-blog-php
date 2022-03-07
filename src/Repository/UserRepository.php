<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Login;
use App\Dto\MyAccountUpdate;
use App\Dto\Register;
use App\Dto\User;
use App\Exception\LoginException;
use App\Exception\RegisterException;
use function array_key_exists;
use function count;
use DateTime;
use DateTimeImmutable;
use function is_int;
use function is_string;
use PDOException;

class UserRepository extends AbstractRepository
{
    public static function create(Register $register): void
    {
        if (self::userExists('email', $register->email)) {
            throw new RegisterException('Vous avez déjà un compte. Essayez de vous connecter.');
        }

        try {
            $pdo = self::getPDO();
            $sql = 'INSERT INTO users (first_name, last_name, email, password, is_author, is_admin, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, :is_author, :is_admin, :created_at, :updated_at);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'first_name' => $register->firstName,
                'last_name' => $register->lastName,
                'email' => $register->email,
                'password' => $register->password,
                'is_author' => 0,
                'is_admin' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ]);
            if (! self::userExists('email', $register->email)) { // @phpstan-ignore-line
                throw new RegisterException(
                    'Une erreur s’est produite lors de la création de votre compte. Veuillez réessayer ultérieurement.'
                );
            }
        } catch (PDOException) {
            throw new RegisterException(
                'Une erreur s’est produite lors de la création de votre compte. Veuillez réessayer ultérieurement.'
            );
        }
    }

    public static function userExists(string $field, string $value): bool
    {
        $pdo = self::getPDO();
        $sql = 'SELECT email FROM users WHERE ' . $field . ' = :value;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);
        $result = $stmt->fetchAll();

        return $result !== false && count($result) >= 1;
    }

    public static function connectByEmail(Login $login): User
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $login->email,
        ]);
        /** @var array<string, mixed> $result */
        $result = $stmt->fetch();

        if ($result['id'] !== null && isset($result['password']) && is_string($result['password'])) {
            if (! password_verify($login->password, $result['password'])) {
                throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
            }
            unset($result['password']); // On supprime le mot de passe car l'objet $user sera dans la session

            return self::arrayToUser($result);
        }
        throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
    }

    public static function updateInformations(MyAccountUpdate $myAccount): void
    {
        if (self::userExists('id', (string) ($myAccount->id))) {
            $pdo = self::getPDO();
            $sql = 'UPDATE users SET firstName = :firstName, lastName = :lastName, updatedAt = ' . time() . ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => (string) ($myAccount->id),
                'firstName' => $myAccount->firstName,
                'lastName' => $myAccount->lastName,
            ]);
        }
    }

    public static function getUser(string $field, string $value): User
    {
        $pdo = self::getPDO();
        $sql = 'SELECT id, firstName, lastName, email, isAuthor, isAdmin, createdAt, updatedAt FROM users WHERE ' . $field . ' = :value LIMIT 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);
        /** @var array<string, mixed> $result */
        $result = $stmt->fetch();

        return self::arrayToUser($result);
    }

    /**
     * @param array<string, mixed> $array
     */
    private static function arrayToUser(array $array): User
    {
        $user = new User();
        if (array_key_exists('id', $array) && is_int($array['id'])) {
            $user->id = $array['id'];
        }
        if (array_key_exists('firstName', $array) && is_string($array['firstName'])) {
            $user->firstName = $array['firstName'];
        }
        if (array_key_exists('lastName', $array) && is_string($array['lastName'])) {
            $user->lastName = $array['lastName'];
        }
        if (array_key_exists('email', $array) && is_string($array['email'])) {
            $user->email = $array['email'];
        }
        if (array_key_exists('isAuthor', $array) && is_int($array['isAuthor'])) {
            $user->isAuthor = $array['isAuthor'] === 0 ? false : true;
        }
        if (array_key_exists('isAdmin', $array) && is_int($array['isAdmin'])) {
            $user->isAdmin = $array['isAdmin'] === 0 ? false : true;
        }
        if (array_key_exists('createdAt', $array) && is_int($array['createdAt'])) {
            $datetime = new DateTime();
            $datetime->setTimestamp($array['createdAt']);
            $user->createdAt = DateTimeImmutable::createFromMutable($datetime);
        }
        if (array_key_exists('updatedAt', $array) && is_int($array['updatedAt'])) {
            $datetime = new DateTime();
            $datetime->setTimestamp($array['updatedAt']);
            $user->updatedAt = DateTimeImmutable::createFromMutable($datetime);
        }

        return $user;
    }
}
