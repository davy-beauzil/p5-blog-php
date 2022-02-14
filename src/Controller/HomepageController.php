<?php

declare(strict_types=1);

namespace App\Controller;

class HomepageController extends AbstractController
{
    public function index(): void
    {
        $this->render('homepage', [
            'domain' => $_ENV['DOMAIN'],
        ]);
    }

    public function test(): void
    {
        $this->render('homepage', [
            'domain' => $_ENV['DOMAIN'],
        ]);
    }
}
