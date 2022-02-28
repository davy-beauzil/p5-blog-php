<?php

declare(strict_types=1);

namespace App\Controller;

class ErrorController extends AbstractController
{
    public function pageNotFound(string $message = null): void
    {
        $this->render('errors/404', [
            'error' => $message,
        ]);
    }
}
