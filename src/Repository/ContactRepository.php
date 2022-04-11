<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Contact;
use App\Services\AuthServiceProvider;
use App\Services\Exception\ContactException;
use function array_key_exists;
use function count;
use function is_array;
use function is_int;
use PDO;
use PDOException;

class ContactRepository extends AbstractRepository
{
    public function add(Contact $contact): void
    {
        $pdo = self::getPDO();
        if (! AuthServiceProvider::isAuthenticated()) {
            $sql = 'INSERT INTO contact (firstName, lastName, email, message, createdAt, updatedAt) VALUES (:firstName, :lastName, :email, :message, :createdAt, :updatedAt);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'firstName' => $contact->firstName,
                'lastName' => $contact->lastName,
                'email' => $contact->email,
                'message' => $contact->message,
                'createdAt' => time(),
                'updatedAt' => time(),
            ]);
        } else {
            $sql = 'INSERT INTO contact (message, userId, createdAt, updatedAt) VALUES (:message, :userId, :createdAt, :updatedAt);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'message' => $contact->message,
                'userId' => $contact->userId,
                'createdAt' => time(),
                'updatedAt' => time(),
            ]);
        }
        if ($stmt->rowCount() <= 0) {
            throw new ContactException('Une erreur s’est produite lors de la demande de contact');
        }
    }

    public function countContacts(): int
    {
        $pdo = self::getPDO();
        $sql = 'SELECT COUNT(*) as nbr_contacts FROM contact;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        if (is_array($result) && array_key_exists('nbr_contacts', $result) && is_int($result['nbr_contacts'])) {
            return $result['nbr_contacts'];
        }
        throw new PDOException('Le résultat attendu n’est pas au bon format.');
    }

    /**
     * @return Contact[]
     */
    public function getPaginatedContacts(float|int $indexFirstComment, int $lenght): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM contact ORDER BY createdAt DESC LIMIT :indexFirstComment, :lenght;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'indexFirstComment' => $indexFirstComment,
            'lenght' => $lenght,
        ]);
        $contacts = $stmt->fetchAll(PDO::FETCH_CLASS, Contact::class);
        if (is_array($contacts) && count(array_filter($contacts, function ($contact) {
            return ! ($contact instanceof Contact);
        })) === 0) {
            return $contacts;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des contacts.');
    }

    public function delete(mixed $contactId): void
    {
        $pdo = self::getPDO();
        $sql = 'DELETE FROM contact WHERE id = :contactId';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'contactId' => $contactId,
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new ContactException('Une erreur s’est produite lors de la suppression de la demande de contact');
        }
    }
}
