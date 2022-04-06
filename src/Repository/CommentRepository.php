<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Article\Article as ArticleDto;
use App\Dto\Article\ArticleWithUser;
use App\Model\Article;
use App\Model\User;
use App\Services\AuthServiceProvider;
use App\Services\Exception\CommentException;
use App\Services\Exception\CreateArticleException;
use function array_key_exists;
use function count;
use function is_array;
use function is_int;
use PDO;
use PDOException;

class CommentRepository extends AbstractRepository
{
    public function add(string $comment, User $user, string $articleId): void
    {
        $pdo = self::getPDO();
        $sql = 'INSERT INTO comment (content, isApprouved, userId, articleId, createdAt, updatedAt) VALUES (:content, :isApprouved, :userId, :articleId, :createdAt, :updatedAt);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'content' => $comment,
            'isApprouved' => $user->isAdmin,
            'userId' => $user->id,
            'articleId' => $articleId,
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
        if($stmt->rowCount() <= 0){
            throw new CommentException('Une erreur s’est produite lors de l’enregistrement du commentaire.');
        }
    }
}
