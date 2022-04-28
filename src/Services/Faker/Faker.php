<?php

declare(strict_types=1);

namespace App\Services\Faker;

use App\Dto\Article\Article;
use App\Dto\Register;
use App\Dto\User;
use App\Model\Contact;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use function is_int;

require_once 'vendor/autoload.php';

class Faker
{
    private ArticleRepository $articleRepository;

    private UserRepository $userRepository;

    private CommentRepository $commentRepository;

    private ContactRepository $contactRepository;

    private Generator $faker;

    /**
     * @var \App\Model\User[]
     */
    private array $users;

    /**
     * @var \App\Model\Article[]
     */
    private array $articles;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->userRepository = new UserRepository();
        $this->commentRepository = new CommentRepository();
        $this->contactRepository = new ContactRepository();
        $this->faker = Factory::create();
    }

    public function fake(): void
    {
        $this->fakeUsers();
        $this->fakeArticles();
        $this->fakeComments();
        $this->fakeContacts();
    }

    private function fakeUsers(): void
    {
        $this->userRepository->createAdmin();
        for ($i = 0; $i < 25; ++$i) {
            $password = $this->faker->password;
            $user = new Register(
                $this->faker->firstName(),
                $this->faker->lastName(),
                $this->faker->email(),
                $password,
                $password,
            );
            $this->userRepository->create($user);
        }
        $this->users = $this->userRepository->getAll();
    }

    private function fakeArticles(): void
    {
        for ($i = 0; $i < 25; ++$i) {
            /** @var User $user */
            $user = $this->users[array_rand($this->users, 1)];
            $article = new Article(
                $this->faker->paragraph(1),
                $this->faker->paragraph(),
                $this->faker->paragraph(20),
                $user->id
            );
            $this->articleRepository->create($article);
        }
        $this->articles = $this->articleRepository->getArticles();
    }

    private function fakeComments(): void
    {
        foreach ($this->articles as $article) {
            for ($i = 0; $i < random_int(1, 10); ++$i) {
                /** @var \App\Model\Article $article */
                $article = $this->articles[array_rand($this->articles)];
                if (is_int($article->id)) {
                    $this->commentRepository->add(
                        $this->faker->paragraph(random_int(1, 3)),
                        $this->users[array_rand($this->users)],
                        (string) $article->id
                    );
                }
            }
        }
    }

    private function fakeContacts(): void
    {
        /** @var \App\Model\User $user */
        foreach ($this->users as $user) {
            for ($i = 0; $i < random_int(0, 2); ++$i) {
                $isLoggedIn = random_int(0, 1);
                $contact = new Contact();
                if ($isLoggedIn === 1) {
                    $user = $this->users[array_rand($this->users, 1)];
                    $contact->userId = $user->id;
                } else {
                    $contact->firstName = $this->faker->firstName();
                    $contact->lastName = $this->faker->lastName();
                    $contact->email = $this->faker->email();
                }
                $contact->message = $this->faker->paragraph(random_int(1, 5));
                $this->contactRepository->add($contact);
            }
        }
    }
}
