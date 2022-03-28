<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Router\Parameters;
use PDOException;

class UserController extends AbstractController
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Affiche la page du compte courant.
     */
    public function user(Parameters $parameters): void
    {
        /** @var ?string $id */
        $id = $parameters->get['id'];
        if ($id === null) {
            $this->redirectToRoute('homepage');
        }

        try {
            $user = $this->repository->getUser('id', (string) $id);
            $this->render('user', [
                'user' => $user,
            ]);
        } catch (PDOException) {
            $this->redirectToRoute('homepage', [
                'error' => 'L’utilisateur est introuvable',
            ]);
        }
    }
}
