<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Article\Article as ArticleDto;
use App\Dto\Article\ArticleWithUser;
use App\Model\Article;
use App\Services\Exception\CreateArticleException;
use function array_key_exists;
use function count;
use function is_array;
use function is_int;
use PDO;
use PDOException;

class ArticleRepository extends AbstractRepository
{
    /**
     * @return Article[]
     */
    public function getArticles(): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM article';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
        if (is_array($articles) && count(array_filter($articles, function ($article) {
            return ! ($article instanceof Article);
        })) === 0) {
            return $articles;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération de l’article');
    }

    public function getArticle(string $id): Article
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM article WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        $article = $stmt->fetchObject(Article::class);
        if ($article instanceof Article) {
            return $article;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération de l’article');
    }

    public function getArticleWithAuthor(string $id): ArticleWithUser
    {
        $pdo = self::getPDO();
        $sql = 'SELECT article.*, users.firstName as userFirstName, users.lastName as userLastName FROM article INNER JOIN users ON article.userId = users.id WHERE article.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        $article = $stmt->fetchObject(ArticleWithUser::class);
        if ($article instanceof ArticleWithUser) {
            return $article;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération de l’article');
    }

    /**
     * @return ArticleWithUser[]
     */
    public function getPaginatedArticles(int $indexFirstArticle, int $lenght): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT article.*, users.firstName as userFirstName, users.lastName as userLastName FROM article INNER JOIN users ON article.userId = users.id ORDER BY article.createdAt DESC LIMIT :indexFirstArticle, :lenght;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'indexFirstArticle' => $indexFirstArticle,
            'lenght' => $lenght,
        ]);
        $articles = $stmt->fetchAll(PDO::FETCH_CLASS, ArticleWithUser::class);
        if (is_array($articles) && count(array_filter($articles, function ($article) {
            return ! ($article instanceof ArticleWithUser);
        })) === 0) {
            return $articles;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des articles');
    }

    public function countArticles(): int
    {
        $pdo = self::getPDO();
        $sql = 'SELECT COUNT(*) as nbr_articles FROM article';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        if (is_array($result) && array_key_exists('nbr_articles', $result) && is_int($result['nbr_articles'])) {
            return $result['nbr_articles'];
        }
        throw new PDOException('Le résultat attendu n’est pas au bon format.');
    }

    public function create(ArticleDto $createArticle): void
    {
        $pdo = self::getPDO();
        $sql = 'INSERT INTO article (title, excerpt, content, userId, createdAt, updatedAt) VALUES (:title, :excerpt, :content, :userId, :createdAt, :updatedAt);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $createArticle->title,
            'excerpt' => $createArticle->excerpt,
            'content' => $createArticle->content,
            'userId' => $createArticle->userId,
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);

        if ($stmt->rowCount() === 0) {
            throw new CreateArticleException('Une erreur s’est produite lors de la création de l’article');
        }
    }

    public function delete(string $id): void
    {
        $pdo = self::getPDO();
        $sql = 'DELETE FROM article WHERE id = :id;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        if ($stmt->rowCount() === 0) {
            throw new CreateArticleException('Une erreur s’est produite lors de la suppression de l’article');
        }
    }

    public function update(Article $article): void
    {
        $pdo = self::getPDO();
        $sql = 'UPDATE article SET title = :title, excerpt = :excerpt, content = :content, userId = :userId,  updatedAt = :updatedAt WHERE id = :id;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'userId' => $article->userId,
            'updatedAt' => time(),
            'id' => $article->id,
        ]);

        if ($stmt->rowCount() === 0) {
            throw new CreateArticleException('Une erreur s’est produite lors de la suppression de l’article');
        }
    }

    /**
     * @return Article[]
     */
    public function getLastArticles(int $limit): array
    {
        $pdo = self::getPDO();
        $sql = 'SELECT * FROM article ORDER BY createdAt DESC LIMIT :limit;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'limit' => $limit,
        ]);
        $articles = $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
        if (is_array($articles) && count(array_filter($articles, function ($article) {
            return ! ($article instanceof Article);
        })) === 0) {
            return $articles;
        }
        throw new PDOException('Une erreur s’est produite lors de la récupération des articles');
    }
}
