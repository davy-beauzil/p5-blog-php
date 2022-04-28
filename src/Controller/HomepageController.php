<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Services\CsrfServiceProvider;

class HomepageController extends AbstractController
{
    private ArticleRepository $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function index(): void
    {
        $articles = $this->articleRepository->getLastArticles(3);
        $this->render('pages/homepage', [
            'articles' => $articles,
            'csrf' => CsrfServiceProvider::generate('contact'),
        ]);
    }
}
