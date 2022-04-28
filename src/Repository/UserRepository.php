<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Login;
use App\Dto\MyAccount\UpdateMyAccountIdentity;
use App\Dto\MyAccount\UpdatePassword;
use App\Dto\Register;
use App\Dto\UpdateUser;
use App\Model\User;
use App\Services\Exception\DeleteUserException;
use App\Services\Exception\LoginException;
use App\Services\Exception\RegisterException;
use App\Services\Exception\UpdateIdentityException;
use App\Services\Exception\UpdatePasswordException;
use App\Services\Exception\UpdateUserException;
use App\SuperGlobals\Session;
use function array_key_exists;
use function count;
use function is_array;
use function is_int;
use function is_string;
use const PASSWORD_DEFAULT;
use PDO;
use PDOException;

class UserRepository extends AbstractRepository
{
    public function create(Register $register): void
    {
        if (self::userExists('email', $register->email)) {
            throw new RegisterException('Vous avez déjà un compte. Essayez de vous connecter.');
        }

        $pdo = self::getPDO();
        $sql = 'INSERT INTO users (firstName, lastName, email, password, isValidated, isAdmin, createdAt, updatedAt) VALUES (:firstName, :lastName, :email, :password, :isValidated, :isAdmin, :createdAt, :updatedAt);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $register->firstName,
            'lastName' => $register->lastName,
            'email' => $register->email,
            'password' => password_hash($register->password, PASSWORD_DEFAULT),
            'isValidated' => 0,
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
        $sql = 'SELECT id, firstName, lastName, email, isValidated, isAdmin, createdAt, updatedAt FROM users WHERE ' . $field . ' = :value LIMIT 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);
        $user = $stmt->fetchObject(User::class);
        if ($user instanceof User) {
            return $user;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération de l’utilisateur');
    }

    public function getUserWithPassword(string $field, string $value): User
    {
        $pdo = self::getPDO();
        $sql = 'SELECT id, firstName, lastName, email, password, isValidated, isAdmin, createdAt, updatedAt FROM users WHERE ' . $field . ' = :value LIMIT 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);
        $user = $stmt->fetchObject(User::class);
        if ($user instanceof User) {
            return $user;
        }
        throw new PDOException(
            'Le résultat attendu doit être une instance de Model/User, mais ce n’est pas le cas.'
        );
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

    public function countUsers(): int
    {
        $pdo = self::getPDO();
        $sql = 'SELECT COUNT(*) as nbrUsers FROM users;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        if (is_array($result) && array_key_exists('nbrUsers', $result) && is_int($result['nbrUsers'])) {
            return $result['nbrUsers'];
        }
        throw new PDOException('Le résultat attendu n’est pas au bon format.');
    }

    /**
     * @return User[]
     */
    public function getPaginatedUsers(int $indexFirstUser, int $lenght): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT id, firstName, lastName, email, isValidated, isAdmin FROM users LIMIT :indexFirstUser, :lenght;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'indexFirstUser' => $indexFirstUser,
            'lenght' => $lenght,
        ]);
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
        if (is_array($users) && count(array_filter($users, function ($user) {
            return ! ($user instanceof User);
        })) === 0) {
            return $users;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des articles');
    }

    public function delete(int $userId): void
    {
        $pdo = self::getPDO();
        $sql = 'DELETE FROM users WHERE id = :userId;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
        ]);
        if ($stmt->rowCount() === 0) {
            throw new DeleteUserException('Une erreur est survenue lors de la suppression de l’utilisateur');
        }
    }

    public function updateUserFromDashboard(UpdateUser $updateUser): void
    {
        $pdo = self::getPDO();
        $sql = 'UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, isValidated = :isValidated, updatedAt = :updatedAt WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $updateUser->firstName,
            'lastName' => $updateUser->lastName,
            'email' => $updateUser->email,
            'isValidated' => $updateUser->isValidated === 'on' ? '1' : '0',
            'updatedAt' => time(),
            'id' => $updateUser->id,
        ]);

        if ($stmt->rowCount() < 1) {
            throw new UpdateUserException('L’utilisateur n’a pas pu être modifié pour une raison inconnue');
        }
    }

    public function createAdmin(): void
    {
        $pdo = self::getPDO();
        $sql = 'INSERT INTO users (firstName, lastName, email, password, isValidated, isAdmin, createdAt, updatedAt) VALUES (:firstName, :lastName, :email, :password, :isValidated, :isAdmin, :createdAt, :updatedAt);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => 'admin',
            'lastName' => 'admin',
            'email' => 'admin@test.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'isValidated' => '1',
            'isAdmin' => '1',
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);

        if ($stmt->rowCount() < 1) {
            throw new UpdateUserException('Le compte administrateur n’a pas pu être créé');
        }
    }

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM users;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
        if (is_array($users) && count(array_filter($users, function ($user) {
            return ! ($user instanceof User);
        })) === 0) {
            return $users;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des utilisateurs');
    }

    /**
     * @return User[]
     */
    public function findAllAdmin(): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM users WHERE isAdmin = 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
        if (is_array($users) && count(array_filter($users, function ($user) {
            return ! ($user instanceof User);
        })) === 0) {
            return $users;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des utilisateurs');
    }
}
