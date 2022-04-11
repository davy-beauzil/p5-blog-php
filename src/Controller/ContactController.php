<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\ContactException;
use App\Services\Validator\ContactValidator;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;
use PDOException;

class ContactController extends AbstractController
{
    public const NBR_CONTACTS_PER_PAGE = 10;

    private ContactValidator $contactValidator;

    private ContactRepository $contactRepository;

    private Voters $voters;

    public function __construct()
    {
        $this->contactValidator = new ContactValidator();
        $this->contactRepository = new ContactRepository();
        $this->voters = new Voters();
    }

    public function index(): void
    {
        $this->render('contact', [
            'csrf' => CsrfServiceProvider::generate('contact'),
        ]);
    }

    public function contact(Parameters $parameters): void
    {
        try {
            $contact = $this->contactValidator->validate($parameters);
            $this->contactRepository->add($contact);
            $this->redirectToRoute('contact', [
                'success' => 'Votre message a bien été envoyé',
            ]);
        } catch (ContactException $e) {
            $this->redirectToRoute('contact', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function manager(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            /** @var ?string $page */
            $page = $parameters->get['page'] ?? null;
            $page = ctype_digit($page) ? (int) $page : 1;
            $page = $page <= 0 ? 1 : $page;
            $nbrContacts = $this->contactRepository->countContacts();
            $pages = ceil($nbrContacts / self::NBR_CONTACTS_PER_PAGE);
            $page = $page > $pages ? 1 : $page;
            $firstContact = ($page - 1) * self::NBR_CONTACTS_PER_PAGE;
            $contacts = $this->contactRepository->getPaginatedContacts($firstContact, self::NBR_CONTACTS_PER_PAGE);

            $this->render('dashboard/contact/manager', [
                'contacts' => $contacts,
                'pages' => $pages,
                'currentPage' => $page,
            ]);
        } catch (PDOException) {
            $this->render404('Une erreur s’est produite...');
        }
    }

    public function delete(Parameters $parameters): void
    {
        try {
            $contactId = $parameters->get['contact_id'];
            $this->contactRepository->delete($contactId);
            $this->redirectToLastPage([
                'success' => 'La demande de contact a bien été supprimée',
            ]);
        } catch (ContactException $e) {
            $this->redirectToLastPage([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
