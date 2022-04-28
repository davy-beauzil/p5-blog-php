<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\AuthServiceProvider;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;

class LogoutController extends AbstractController
{
    private Voters $voters;

    public function __construct()
    {
        $this->voters = new Voters();
    }

    /*
     * GET /logout
     */
    public function logout(): void
    {
        if ($this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            AuthServiceProvider::logout();
        }
        $this->redirectToRoute('homepage');
    }
}
