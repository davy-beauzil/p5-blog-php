<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Dto\MyAccount\UpdateMyAccountIdentity;
use App\Services\Exception\UpdateIdentityException;

class UpdateIdentityValidator extends Validator
{
    public function validate(mixed $id, mixed $firstName, mixed $lastName): UpdateMyAccountIdentity
    {
        if (! $this->biggerThan(2, $firstName) || ! $this->onlyAlphabet($firstName)) {
            throw new UpdateIdentityException('Le prénom doit faire au moins 3 caractères');
        }

        if (! $this->biggerThan(2, $lastName) || ! $this->onlyAlphabet($lastName)) {
            throw new UpdateIdentityException('Le nom doit faire au moins 3 caractères');
        }

        /** @var string $id */
        /** @var string $firstName */
        /** @var string $lastName */
        return new UpdateMyAccountIdentity($id, $firstName, $lastName);
    }
}
