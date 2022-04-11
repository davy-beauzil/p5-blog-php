<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Article\Article as ArticleDto;
use App\Dto\Article\ArticleWithUser;
use App\Model\Article;
use App\Model\Contact;
use App\Services\AuthServiceProvider;
use App\Services\Exception\ContactException;
use App\Services\Exception\CreateArticleException;
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
        if(!AuthServiceProvider::isAuthenticated()){
            $sql = 'INSERT INTO contact (firstName, lastName, email, message, createdAt, updatedAt) VALUES (:firstName, :lastName, :email, :message, :createdAt, :updatedAt);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'firstName' => $contact->firstName,
                'lastName' => $contact->lastName,
                'email' => $contact->email,
                'message' => $contact->message,
                'createdAt' => time(),
                'updatedAt' => time()
            ]);
        }else{
            $sql = 'INSERT INTO contact (message, userId, createdAt, updatedAt) VALUES (:message, :userId, :createdAt, :updatedAt);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'message' => $contact->message,
                'userId' => $contact->userId,
                'createdAt' => time(),
                'updatedAt' => time()
            ]);
        }
        if($stmt->rowCount() <= 0){
            throw new ContactException('Une erreur s’est produite lors de la demande de contact');
        }
    }
}
