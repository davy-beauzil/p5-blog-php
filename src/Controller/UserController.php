<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\MyAccount\UpdateMyAccountIdentity;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\UpdateMyAccountIdentityException;
use App\Services\Validator\UpdateMyAccountIdentityValidator;
use App\Services\Voters\IsCurrentUserVoter;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Session;
use function is_string;

class UserController extends AbstractController
{
    public const CSRF_IDENTITY_ID = 'updateMyAccountIdentity';

    public const CSRF_PASSWORD_ID = 'updateMyAccountPassword';

    private Voters $voters;

    private UpdateMyAccountIdentityValidator $identityValidator;

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->voters = new Voters();
        $this->identityValidator = new UpdateMyAccountIdentityValidator();
        $this->userRepository = new UserRepository();
    }

    /**
     * Affiche la page du compte courant.
     */
    public function myAccount(): void
    {
        if (! $this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }
        $this->render('user/myAccount', [
            'csrf' => CsrfServiceProvider::generate(self::CSRF_IDENTITY_ID),
        ]);
    }

    /**
     * Modification du compte courant (nom & prénom).
     */
    public function updateMyAccountIdentity(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsCurrentUserVoter::IS_SAME, $parameters->put['id'])) {
            $this->redirectToRoute('homepage');
        }

        try {
            $identity = $this->checkMyAccountUpdate($parameters);
            $user = $this->userRepository->updateIdentity($identity);
            Session::forget('user');
            Session::put('user', $user);
        } catch (UpdateMyAccountIdentityException) {
            $this->render('user/myAccount', [
                'messages' => [[
                    'type' => 'error',
                    'text' => 'Une erreur est survenue lors de la mise à jour de votre compte, veuillez réessayer.',
                ]],
                'csrf' => CsrfServiceProvider::generate(self::CSRF_IDENTITY_ID),
            ]);
        }

        $this->redirectToRoute('myAccount');
    }

    /**
     * Modification du mot de passe du compte courant.
     */
    public function updateMyAccountPassword(): void
    {
    }

    private function checkMyAccountUpdate(Parameters $parameters): UpdateMyAccountIdentity
    {
        if (! $parameters->has(Parameters::PUT, 'id', 'firstName', 'lastName', '_csrf')) {
            throw new UpdateMyAccountIdentityException('Un des champs id, firstName, lastName ou _csrf est manquant.');
        }
        if (! is_string($parameters->put['_csrf'])) {
            throw new UpdateMyAccountIdentityException(
                'Une erreur est survenue lors de votre inscription, veuillez réessayer'
            );
        }
        $updateMyAccountIdentity = $this->identityValidator->validate(
            $parameters->put['id'],
            $parameters->put['firstName'],
            $parameters->put['lastName'],
        );
        $checkCsrf = CsrfServiceProvider::validate('updateMyAccountIdentity', $parameters->put['_csrf']);
        if ($checkCsrf === false) {
            throw new UpdateMyAccountIdentityException('Le CSRF n’est pas valide');
        }

        return $updateMyAccountIdentity;
    }
}
