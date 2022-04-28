<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Contact;
use App\Repository\ContactRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\ContactException;
use App\Services\Validator\ContactValidator;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Env;
use DateTime;
use Exception;
use function is_string;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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
            $this->sendEmail($contact);
            $this->redirectToLastPage([
                'success' => 'Votre message a bien été envoyé',
            ]);
        } catch (ContactException $e) {
            $this->redirectToLastPage([
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
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

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

    private function sendEmail(Contact $contact): void
    {
        $adminEmail = Env::get('ADMIN_EMAIL');
        if (is_string($adminEmail)) {
            $mailer = new PHPMailer(true);
            $createdAt = new DateTime();
            $createdAt->setTimestamp(time());
            try {
                //Server settings
                $mailer->SMTPDebug = SMTP::DEBUG_SERVER;
                $mailer->isSMTP();
                $mailer->Host = 'smtp.hostinger.com';
                $mailer->SMTPAuth = true;
                $mailer->Username = 'contact@davy-beauzil.fr';
                $mailer->Password = 'Jeunes@peurp16';
                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mailer->Port = 465;

                //Recipients
                $mailer->setFrom('contact@davy-beauzil.fr', 'P5 Blog php');
                $mailer->addReplyTo('contact@davy-beauzil.fr', 'P5 Blog php');
                $mailer->addAddress($adminEmail, 'Admin P5');

                //Content
                $mailer->isHTML(true);
                $mailer->addCustomHeader('MIME-Version', '1.0');
                $mailer->addCustomHeader('Content-Type', 'text/html; charset=utf-8');
                $mailer->Subject = 'Nouvelle demande de contact !';
                $mailer->Body = sprintf('<!DOCTYPE html>
                                            <html lang="fr">
                                                <head>
                                                    <meta charset="utf-8">
                                                    <title>Nouvelle demande de contact !</title>
                                                </head>
                                                <body>
                                                    <h1> %s %s vous a contacté</h1>
                                                    <p>%s</p>
                                                    <a href="mailto:%s">Répondre</a>
                                                </body>
                                            </html>', $contact->firstName, $contact->lastName, $contact->message, $contact->email);

                $mailer->send();
            } catch (Exception $e) {
                throw new ContactException($e->getMessage());
            }
        }
    }
}
