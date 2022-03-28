<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UpdateUser;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\UpdateUserException;
use App\Services\Validator\UpdateUserValidator;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;
use function is_string;
use PDOException;

class UsersDashboardController extends AbstractController
{
    public const NBR_USERS_PER_PAGE = 25;

    private Voters $voters;

    private UserRepository $userRepository;

    private UpdateUserValidator $updateUserValidator;

    public function __construct()
    {
        $this->voters = new Voters();
        $this->userRepository = new UserRepository();
        $this->updateUserValidator = new UpdateUserValidator();
    }

    public function index(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        /** @var ?string $page */
        $page = $parameters->get['page'] ?? null;
        $page = ctype_digit($page) ? (int) $page : 1;
        $page = $page <= 0 ? 1 : $page;

        $nbrUsers = $this->userRepository->countUsers();
        $pages = ceil($nbrUsers / self::NBR_USERS_PER_PAGE);
        $firstUser = ($page - 1) * self::NBR_USERS_PER_PAGE;
        $users = $this->userRepository->getPaginatedUsers($firstUser, self::NBR_USERS_PER_PAGE);
        $this->render('dashboard/users/manager', [
            'users' => $users,
            'pages' => $pages,
            'currentPage' => $page,
        ]);
    }

    public function delete(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }
        /** @var ?string $userId */
        $userId = $parameters->get['id'] ?? null;
        if (ctype_digit($userId)) {
            $this->userRepository->delete((int) $userId);
        }
        $this->redirectToRoute('adminUsers');
    }

    public function updateIndex(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        /** @var ?string $userId */
        $userId = $parameters->get['id'] ?? null;
        if (! ctype_digit($userId)) {
            $this->redirectToRoute('homepage');
        }

        $user = $this->userRepository->getUser('id', (string) $userId);
        $this->render('dashboard/users/update', [
            'user' => $user,
            'csrf' => CsrfServiceProvider::generate('update-user'),
        ]);
    }

    /**
     * Modification d'un compte.
     */
    public function update(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            $updateUser = $this->checkUpdate($parameters);
            $this->userRepository->updateUserFromDashboard($updateUser);
            $this->redirectToRoute('adminUsers', [
                'success' => 'Le compte a bien été mis à jour',
            ]);
        } catch (UpdateUserException $e) {
            $this->redirectToRoute('adminUsers', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function user(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }
        /** @var ?string $userId */
        $userId = $parameters->get['id'];
        if ($userId === null) {
            $this->redirectToRoute('adminUsers', [
                'error' => 'Le compte de l’utilisateur n’a pas été trouvé',
            ]);
        }
        try {
            $user = $this->userRepository->getUser('id', (string) $userId);
            $this->render('dashboard/user', [
                'user' => $user,
            ]);
        } catch (PDOException) {
            $this->redirectToRoute('adminUsers', [
                'error' => 'Le compte de l’utilisateur n’a pas été trouvé',
            ]);
        }
    }

    private function checkUpdate(Parameters $parameters): UpdateUser
    {
        if (! $parameters->has(Parameters::PUT, 'id', 'firstName', 'lastName', 'email', 'isValidated', '_csrf')) {
            throw new UpdateUserException(
                'Un des champs id, firstName, lastName, email, isValidated ou _csrf est manquant.'
            );
        }
        if (! is_string($parameters->put['_csrf'])) {
            throw new UpdateUserException('Une erreur est survenue lors de votre inscription, veuillez réessayer');
        }
        $updateUser = $this->updateUserValidator->validate($parameters);
        $checkCsrf = CsrfServiceProvider::validate('update-user', $parameters->put['_csrf']);
        if ($checkCsrf === false) {
            throw new UpdateUserException('Le CSRF n’est pas valide');
        }

        return $updateUser;
    }
}
