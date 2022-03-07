<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\MyAccountUpdate;
use App\Exception\MyAccountUpdateException;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Server\Session;
use App\Validator\MyAccountUpdateValidator;
use function is_string;

class MyAccountService
{
    /**
     * @return array<string, string>
     */
    public static function updateInformations(Parameters $parameters): array
    {
        try {
            $myAccount = self::createMyAccount($parameters);
        } catch (MyAccountUpdateException $e) {
            return [
                'type' => 'error',
                'text' => $e->getMessage(),
            ];
        }

        $isValid = MyAccountUpdateValidator::validate($myAccount);
        if ($isValid) {
            UserRepository::updateInformations($myAccount);
            $user = UserRepository::getUser('id', (string) ($myAccount->id));
            Session::forget('user');
            Session::put('user', $user);
        }

        return [
            'type' => 'success',
            'text' => 'Votre compte a bien été modifié.',
        ];
    }

    public static function updatePassword(Parameters $parameters): void
    {
    }

    private static function createMyAccount(Parameters $parameters): MyAccountUpdate
    {
        if (is_string($parameters->put['id']) &&
            is_string($parameters->put['firstName']) &&
            is_string($parameters->put['lastName'])
        ) {
            return new MyAccountUpdate(
                (int) ($parameters->put['id']),
                $parameters->put['firstName'],
                $parameters->put['lastName'],
            );
        }
        throw new MyAccountUpdateException(
            'Une erreur s’est produite lors de la modification de votre compte. Veuillez réessayer ultérieurement.'
        );
    }
}
