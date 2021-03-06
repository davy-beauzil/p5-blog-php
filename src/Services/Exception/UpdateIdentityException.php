<?php

declare(strict_types=1);

namespace App\Services\Exception;

use Exception;
use Stringable;
use Throwable;

class UpdateIdentityException extends Exception implements Stringable
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
