<?php

namespace App\Services\Validator;

use App\Dto\UpdateUser;
use App\Router\Parameters;
use App\Services\Exception\UpdateUserException;

class UpdateUserValidator extends Validator
{
    public function validate(Parameters $parameters): UpdateUser
    {
        if($parameters->put['id'] === null ||
            $parameters->put['firstName'] === null ||
            $parameters->put['lastName'] === null ||
            $parameters->put['email'] === null ||
            $parameters->put['isValidated'] === null
        ) {
            throw new UpdateUserException('Un des champs pour la modification d’un utilisateur est manquant');
        }

        if (! $this->biggerThan(2, $parameters->put['firstName']) || ! $this->onlyAlphabet($parameters->put['firstName'])) {
            throw new UpdateUserException('Le prénom doit faire au moins 3 caractères');
        }

        if (! $this->biggerThan(2, $parameters->put['lastName']) || ! $this->onlyAlphabet($parameters->put['lastName'])) {
            throw new UpdateUserException('Le nom doit faire au moins 3 caractères');
        }

        if(! $this->isEmail($parameters->put['email'])){
            throw new UpdateUserException('L’adresse email n’est pas au bon format');
        }

        if(!in_array($parameters->put['isValidated'], ['off', 'on'])){
            throw new UpdateUserException('Le paramètre "compte validé ?" n’est pas au bon format');
        }

        /** @var string $id */
        /** @var string $firstName */
        /** @var string $lastName */
        return new UpdateUser($parameters->put['id'],
            $parameters->put['firstName'],
            $parameters->put['lastName'],
            $parameters->put['email'],
            $parameters->put['isValidated']);
    }
}