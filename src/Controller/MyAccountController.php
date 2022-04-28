<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\MyAccount\UpdateMyAccountIdentity;
use App\Dto\MyAccount\UpdatePassword;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\UpdateIdentityException;
use App\Services\Exception\UpdatePasswordException;
use App\Services\Validator\UpdateIdentityValidator;
use App\Services\Validator\UpdatePasswordValidator;
use App\Services\Voters\IsCurrentUserVoter;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Session;
use function is_string;

class MyAccountController extends AbstractController
{
    public const CSRF_IDENTITY_ID = 'updateMyAccountIdentity';

    public const CSRF_PASSWORD_ID = 'updateMyAccountPassword';

    private Voters $voters;

    private UpdateIdentityValidator $identityValidator;

    private UpdatePasswordValidator $passwordValidator;

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->voters = new Voters();
        $this->identityValidator = new UpdateIdentityValidator();
        $this->passwordValidator = new UpdatePasswordValidator();
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
            'csrf_identity' => CsrfServiceProvider::generate(self::CSRF_IDENTITY_ID),
            'csrf_password' => CsrfServiceProvider::generate(self::CSRF_PASSWORD_ID),
        ]);
    }

    /**
     * Modification du compte courant (nom & prénom).
     */
    public function updateIdentity(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsCurrentUserVoter::IS_SAME, $parameters->put['id'])) {
            $this->redirectToRoute('homepage');
        }

        try {
            $identity = $this->checkUpdateIdentity($parameters);
            $user = $this->userRepository->updateIdentity($identity);
            Session::forget('user');
            Session::put('user', $user);
        } catch (UpdateIdentityException) {
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
    public function updatePassword(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsCurrentUserVoter::IS_SAME, $parameters->put['id'])) {
            $this->redirectToRoute('homepage');
        }
        try {
            $updatePassword = $this->checkUpdatePassword($parameters);
            $this->userRepository->changePassword($updatePassword);
            $this->redirectToRoute('myAccount');
        } catch (UpdatePasswordException $e) {
            $this->render('user/myAccount', [
                'messages' => [[
                    'type' => 'error',
                    'text' => $e->getMessage(),
                ]],
                'csrf_identity' => CsrfServiceProvider::generate(self::CSRF_IDENTITY_ID),
                'csrf_password' => CsrfServiceProvider::generate(self::CSRF_PASSWORD_ID),
            ]);
        }
    }

    private function checkUpdateIdentity(Parameters $parameters): UpdateMyAccountIdentity
    {
        if (! $parameters->has(Parameters::PUT, 'id', 'firstName', 'lastName', '_csrf')) {
            throw new UpdateIdentityException('Un des champs id, firstName, lastName ou _csrf est manquant.');
        }
        if (! is_string($parameters->put['_csrf'])) {
            throw new UpdateIdentityException('Une erreur est survenue lors de votre inscription, veuillez réessayer');
        }
        $updateMyAccountIdentity = $this->identityValidator->validate(
            $parameters->put['id'],
            $parameters->put['firstName'],
            $parameters->put['lastName'],
        );
        $checkCsrf = CsrfServiceProvider::validate(self::CSRF_IDENTITY_ID, $parameters->put['_csrf']);
        if ($checkCsrf === false) {
            throw new UpdateIdentityException('Le CSRF n’est pas valide');
        }

        return $updateMyAccountIdentity;
    }

    private function checkUpdatePassword(Parameters $parameters): UpdatePassword
    {
        if (! $parameters->has(
            Parameters::PUT,
            'id',
            'currentPassword',
            'newPassword',
            'confirmationNewPassword',
            '_csrf'
        )) {
            throw new UpdatePasswordException('Un des champs est manquant.');
        }
        if (! is_string($parameters->put['_csrf'])) {
            throw new UpdatePasswordException('Une erreur est survenue lors de votre inscription, veuillez réessayer');
        }
        $updatePassword = $this->passwordValidator->validate(
            $parameters->put['id'],
            $parameters->put['currentPassword'],
            $parameters->put['newPassword'],
            $parameters->put['confirmationNewPassword'],
        );
        $checkCsrf = CsrfServiceProvider::validate(self::CSRF_PASSWORD_ID, $parameters->put['_csrf']);
        if ($checkCsrf === false) {
            throw new UpdatePasswordException('Le CSRF n’est pas valide');
        }

        return $updatePassword;
    }
}
