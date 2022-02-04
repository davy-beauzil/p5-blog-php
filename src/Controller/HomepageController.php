<?php

namespace App\Controller;

class HomepageController extends AbstractController
{
    public function index()
    {
        $this->render('homepage', [
            'domain' => $_ENV['DOMAIN']
        ]);
    }

    public function test()
    {
        $this->render('homepage', [
            'domain' => $_ENV['DOMAIN']
        ]);
    }

    public function article(array $parameters)
    {
        dd('je suis sur la bonne route');
        $this->render('homepage', $parameters);
    }
}