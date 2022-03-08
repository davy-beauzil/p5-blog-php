<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Parameters;
use App\Services\MyAccountService;
use App\Voters\IsCurrentUserVoter;
use App\Voters\IsLoggedInVoter;
use App\Voters\Voters;

class UserController extends AbstractController
{
    public function myAccount(Parameters $parameters): void
    {
        if (! Voters::vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }

        $this->render('user/myAccount');
    }

    public function myAccountUpdate(Parameters $parameters): void
    {
        if (! Voters::vote(IsCurrentUserVoter::IS_SAME, (int) ($parameters->put['id']))) {
            $this->redirectToRoute('homepage');
        }
        $result = [];
        if ($parameters->has(Parameters::PUT, 'id', 'firstName', 'lastName')) {
            $result = MyAccountService::updateInformations($parameters);
        }
        $this->render('user/myAccount', [
            'messages' => [$result],
        ]);
    }

    public function myAccountUpdatePassword(Parameters $parameters): void
    {
    }
}
