<?php

namespace App\Services\Validator;

use App\Model\Contact;
use App\Router\Parameters;
use App\Services\AuthServiceProvider;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\ContactException;

class ContactValidator extends Validator
{
    public function validate(Parameters $parameters): Contact
    {
        $firstName = $parameters->post['firstName'];
        $lastName = $parameters->post['lastName'];
        $email = $parameters->post['email'];
        $message = $parameters->post['message'];

        if(!is_string($firstName) || !is_string($lastName) || !is_string($email) || !is_string($message)){
            throw new ContactException('Un des champs est au mauvais format');
        }
        if(!AuthServiceProvider::isAuthenticated()){
            if (! $parameters->has(Parameters::POST, 'firstName', 'lastName', 'email', 'message', '_csrf')) {
                throw new ContactException('Un des champs est manquant pour la demande de contact');
            }
            if (! $this->biggerThan(0, $parameters->post['firstName']) || ! is_string($parameters->post['firstName'])) {
                throw new ContactException('Le prénom ne doit pas être vide.');
            }
            if (! $this->biggerThan(0, $parameters->post['lastName']) || ! is_string($parameters->post['lastName'])) {
                throw new ContactException('Le nom ne doit pas être vide.');
            }
            if (! $this->isEmail($parameters->post['email']) || ! is_string($parameters->post['email'])) {
                throw new ContactException('Ce n’est pas un email valide');
            }
        }else{
            if (! $parameters->has(Parameters::POST,'message', '_csrf')) {
                throw new ContactException('Un des champs est manquant pour la demande de contact');
            }
        }
        if (! $this->lowerThan(1001, $parameters->post['message']) || ! is_string($parameters->post['message'])) {
            throw new ContactException('Le message doit faire 1000 caractères maximum');
        }
        if(!is_string($parameters->post['_csrf']) || !CsrfServiceProvider::validate('contact', $parameters->post['_csrf'])){
            throw new ContactException('Le formulaire est invalide.');
        }

        $contact = new Contact();
        if(AuthServiceProvider::isAuthenticated()){
            return $contact->createForLoggedInUser($message);
        }else{
            return $contact->createForLogoutUser($firstName, $lastName, $email, $message);
        }
    }
}