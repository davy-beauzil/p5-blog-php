<?php

namespace App\Controller;

class ErrorController extends AbstractController
{
    public function pageNotFound()
    {
        $this->render('errors/404');
    }
}