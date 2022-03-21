<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Login;
use App\Dto\MyAccount\UpdateMyAccountIdentity;
use App\Dto\MyAccount\UpdatePassword;
use App\Dto\Register;
use App\Model\User;
use App\Services\Exception\LoginException;
use App\Services\Exception\RegisterException;
use App\Services\Exception\UpdateIdentityException;
use App\Services\Exception\UpdatePasswordException;
use App\SuperGlobals\Session;
use function count;
use function is_string;
use const PASSWORD_DEFAULT;
use PDOException;

class UserRepository extends AbstractRepository
{
    public function create(Register $register): void
    {
        if (self::userExists('email', $register->email)) {
            throw new RegisterException('Vous avez déjà un compte. Essayez de vous connecter.');
        }

        $pdo = self::getPDO();
        $sql = 'INSERT INTO users (firstName, lastName, email, password, isAuthor, isAdmin, createdAt, updatedAt) VALUES (:firstName, :lastName, :email, :password, :isAuthor, :isAdmin, :createdAt, :updatedAt);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $register->firstName,
            'lastName' => $register->lastName,
            'email' => $register->email,
            'password' => password_hash($register->password, PASSWORD_DEFAULT),
            'isAuthor' => 0,
            'isAdmin' => 0,
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new RegisterException('Votre compte n’a pas pu être créé, veuillez réessayer ultérieurement.');
        }
    }

    public function userExists(string $field, string $value): bool
    {
        try {
            $pdo = self::getPDO();
        } catch (PDOException) {
            throw new PDOException(
                'Impossible de récupérer une instance PDO. Vérifiez que la base de données est bien démarrée.'
            );
        }

        $sql = 'SELECT email FROM users WHERE ' . $field . ' = :value;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);
        $result = $stmt->fetchAll();

        return $result !== false && count($result) >= 1;
    }

    public function connectByEmail(Login $login): void
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $login->email,
        ]);
        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        if (
            $user->id === null ||
            ! is_string($user->password) ||
            ! password_verify($login->password, $user->password)
        ) {
            throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
        }
        $user->password = null;
        Session::put('user', $user);
    }

    public function updateIdentity(UpdateMyAccountIdentity $myAccount): User
    {
        if (self::userExists('id', $myAccount->id)) {
            $pdo = self::getPDO();
            $sql = 'UPDATE users SET firstName = :firstName, lastName = :lastName, updatedAt = ' . time() . ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $myAccount->id,
                'firstName' => $myAccount->firstName,
                'lastName' => $myAccount->lastName,
            ]);
            if ($stmt->rowCount() > 0) {
                return $this->getUser('id', $myAccount->id);
            }
        }
        throw new UpdateIdentityException('Votre compte n’a pas pu être mis à jour, veuillez réessayer');
    }

    public function getUser(string $field, string $value): User
    {
        $pdo = self::getPDO();
        $sql = 'SELECT id, firstName, lastName, email, isAuthor, isAdmin, createdAt, updatedAt FROM users WHERE ' . $field . ' = :value LIMIT 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);

        return $stmt->fetchObject(User::class);
    }

    public function getUserWithPassword(string $field, string $value): User
    {
        $pdo = self::getPDO();
        $sql = 'SELECT id, firstName, lastName, email, password, isAuthor, isAdmin, createdAt, updatedAt FROM users WHERE ' . $field . ' = :value LIMIT 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);

        return $stmt->fetchObject(User::class);
    }

    public function changePassword(UpdatePassword $updatePassword): void
    {
        $user = $this->getUserWithPassword('id', $updatePassword->id);
        if ($user->password !== null && ! password_verify($updatePassword->currentPassword, $user->password)) {
            throw new UpdatePasswordException('L’ancien mot de passe est incorrect');
        }

        $pdo = self::getPDO();
        $sql = 'UPDATE users SET password = :password, updatedAt = ' . time() . ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $updatePassword->id,
            'password' => password_hash($updatePassword->newPassword, PASSWORD_DEFAULT),
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new UpdateIdentityException('Votre mot de passe n’a pas pu être mis à jour, veuillez réessayer');
        }
    }
}
