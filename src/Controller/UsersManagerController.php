<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;

class UsersManagerController extends AbstractController
{
    private Voters $voters;

    public function __construct()
    {
        $this->voters = new Voters();
    }

    public function index(): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }
        $this->render('admin/user-manager');
    }
}
