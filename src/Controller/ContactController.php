<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\ContactException;
use App\Services\Validator\ContactValidator;

class ContactController extends AbstractController
{
    private ContactValidator $contactValidator;
    private ContactRepository $contactRepository;

    public function __construct()
    {
        $this->contactValidator = new ContactValidator();
        $this->contactRepository = new ContactRepository();
    }

    public function index(): void
    {
        $this->render('contact', [
            'csrf' => CsrfServiceProvider::generate('contact')
        ]);
    }

    public function contact(Parameters $parameters): void
    {
        try{
            $contact = $this->contactValidator->validate($parameters);
            $this->contactRepository->add($contact);
            $this->redirectToRoute('contact', ['success' => 'Votre message a bien été envoyé']);
        }catch(ContactException $e){
            $this->redirectToRoute('contact', ['error' => $e->getMessage()]);
        }
    }
}