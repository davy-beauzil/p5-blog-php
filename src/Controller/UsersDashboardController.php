<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;

class UsersDashboardController extends AbstractController
{
    public const NBR_USERS_PER_PAGE = 25;

    private Voters $voters;

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->voters = new Voters();
        $this->userRepository = new UserRepository();
    }

    public function index(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }
        $page = $parameters->get['page'];
        $page = ctype_digit($page) ? (int) $page : 1;
        $page = $page <= 0 ? 1 : $page;

        $nbrUsers = $this->userRepository->countUsers();
        $pages = ceil($nbrUsers / self::NBR_USERS_PER_PAGE);
        $firstUser = ($page - 1) * self::NBR_USERS_PER_PAGE;
        $users = $this->userRepository->getPaginatedUsers($firstUser, self::NBR_USERS_PER_PAGE);
        $this->render('admin/user-manager', [
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
        $userId = $parameters->get['id'] ?? null;
        if (ctype_digit($userId)) {
            $this->userRepository->delete((int) $userId);
        }
        $this->redirectToRoute('usersDashboard');
    }
}
