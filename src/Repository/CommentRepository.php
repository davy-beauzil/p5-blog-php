<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Comment;
use App\Model\User;
use App\Services\Exception\CommentException;
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
        if ($stmt->rowCount() <= 0) {
            throw new CommentException('Une erreur s’est produite lors de l’enregistrement du commentaire.');
        }
    }

    /**
     * @return Comment[]
     */
    public function getForArticle(string $articleId): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM comment WHERE articleId = :articleId AND isApprouved = 1;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'articleId' => $articleId,
        ]);
        $comments = $stmt->fetchAll(PDO::FETCH_CLASS, Comment::class);
        if (is_array($comments) && count(array_filter($comments, function ($comment) {
            return ! ($comment instanceof Comment);
        })) === 0) {
            return $comments;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des commentaires');
    }

    public function countComments(): int
    {
        $pdo = self::getPDO();
        $sql = 'SELECT COUNT(*) as nbr_comments FROM comment;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        if (is_array($result) && array_key_exists('nbr_comments', $result) && is_int($result['nbr_comments'])) {
            return $result['nbr_comments'];
        }
        throw new PDOException('Le résultat attendu n’est pas au bon format.');
    }

    /**
     * @return Comment[]
     */
    public function getPaginatedComments(int $indexFirstComment, int $lenght): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM comment LIMIT :indexFirstComment, :lenght;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'indexFirstComment' => $indexFirstComment,
            'lenght' => $lenght,
        ]);
        $comments = $stmt->fetchAll(PDO::FETCH_CLASS, Comment::class);
        if (is_array($comments) && count(array_filter($comments, function ($comment) {
            return ! ($comment instanceof Comment);
        })) === 0) {
            return $comments;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des commentaires.');
    }

    public function valid(mixed $commentId): void
    {
        $pdo = self::getPDO();
        $sql = 'UPDATE comment SET isApprouved = 1 WHERE id = :commentId;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'commentId' => $commentId,
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new CommentException('Le commentaire n’a pas pu être validé.');
        }
    }

    public function invalid(mixed $commentId): void
    {
        $pdo = self::getPDO();
        $sql = 'UPDATE comment SET isApprouved = 0 WHERE id = :commentId;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'commentId' => $commentId,
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new CommentException('Le commentaire n’a pas pu être invalidé.');
        }
    }

    public function update(mixed $commentId, string $comment): void
    {
        $pdo = self::getPDO();
        $sql = 'UPDATE comment SET content = :comment WHERE id = :commentId;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'commentId' => $commentId,
            'comment' => $comment,
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new CommentException('Le commentaire n’a pas pu être modifié.');
        }
    }

    public function get(mixed $commentId): Comment
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM comment WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $commentId,
        ]);
        $comment = $stmt->fetchObject(Comment::class);
        if ($comment instanceof Comment) {
            return $comment;
        }
        throw new CommentException('Impossible trouver le commentaire');
    }

    public function delete(int $id): void
    {
        $pdo = self::getPDO();
        $sql = 'DELETE FROM comment WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        if ($stmt->rowCount() <= 0) {
            throw new CommentException('Une erreur s’est produite lors de la suppression de votre commentaire.');
        }
    }
}
