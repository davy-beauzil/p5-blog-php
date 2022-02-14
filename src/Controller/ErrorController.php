<?php

declare(strict_types=1);

namespace App\Controller;

class ErrorController extends AbstractController
{
    public function pageNotFound(): void
    {
        $this->render('errors/404');
    }
}
