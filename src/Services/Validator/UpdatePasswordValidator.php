<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Dto\MyAccount\UpdatePassword;
use App\Services\Exception\UpdatePasswordException;
use function is_string;

class UpdatePasswordValidator extends Validator
{
    public function validate(
        mixed $id,
        mixed $currentPassword,
        mixed $newPassword,
        mixed $confirmationNewPassword
    ): UpdatePassword
    {
        if (! is_string($currentPassword)) {
            throw new UpdatePasswordException('L’ancien mot de passe semble être au mauvais format');
        }

        if (! $this->validatePassword($newPassword)) {
            throw new UpdatePasswordException('Le mot de passe n’est pas valide');
        }

        if ($newPassword !== $confirmationNewPassword) {
            throw new UpdatePasswordException('La confirmation du mot de passe n’est pas identique');
        }

        /** @var string $id */
        /** @var string $currentPassword */
        /** @var string $newPassword */
        return new UpdatePassword($id, $currentPassword, $newPassword);
    }
}
