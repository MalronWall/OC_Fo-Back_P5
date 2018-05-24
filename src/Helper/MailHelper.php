<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class MailHelper extends AbstractController
{
    public function sendMailContact(array $post)
    {
        $myEmailAdress = 'thibaut.tourte17@gmail.com';

        $preheader = 'Formulaire de contact envoyé de votre blog !';
        $image = 'contact.jpg';

        $title = $post['firstname'].' '.$post['lastname'];
        $email = $post['email'];

        $subject = $post['subject'];
        $message = $post['content'];
        
        $link = '';

        $content = $this->render('/mails/contact.html.twig', [
            'preheader' => $preheader,
            'title' => $title,
            'email' => $email,
            'image' => $image,
            'subject' => $subject,
            'content' => $message,
            'link' => $link
        ]);

        $headers =
            'Content-type: text/html'."\r\n".
            'Content-Transfer-Encoding: 8bit'."\r\n".
            'From: Blog de Thibaut Tourte <contact@thibaut-tourte.com>'."\r\n".
            'Reply-To: ' . $email;

        if (mail($myEmailAdress, $subject, $content, $headers) === true) {
            return true;
        }
        return false;
    }

    public function sendMailConfirmationLogon($post, $token)
    {
        $preheader = 'Plus qu\'une étape pour finaliser l\'inscription !';
        $image = 'inscription.jpg';
        $subject = 'Confirmation d\'inscription';
        
        $prenomNom = $post['firstname'].' '.$post['lastname'];
        $pseudo = $post['pseudo'];
        $email = $post['email'];
        
        $link = 'confirm-email/'.$token;

        $content = $this->render('/mails/confirmLogon.html.twig', [
            'preheader' => $preheader,
            'subject' => $subject,
            'prenomNom' => $prenomNom,
            'pseudo' => $pseudo,
            'image' => $image,
            'link' => $link
        ]);

        $headers =
            'Content-type: text/html'."\r\n".
            'Content-Transfer-Encoding: 8bit'."\r\n".
            'From: Blog de Thibaut Tourte <contact@thibaut-tourte.com>'."\r\n".
            'Reply-To: ' . $email;

        if (mail($email, $subject, $content, $headers) === true) {
            return true;
        }
        return false;
    }
    
    public function sendMailForgotPassword($user)
    {
        $preheader = 'Un oubli de mot de passe ? On va arranger ça ! ;)';
        $image = 'motDePasse.jpg';
        $subject = 'Réinitialisation du mot de passe';
        
        $prenomNom = $user->getFirstname().' '.$user->getName();
        $pseudo = $user->getPseudo();
        $email = $user->getEmail();

        $link = 'reset-password/'.$user->getTokenForgotPwd();

        $content = $this->render('/mails/forgotPassword.html.twig', [
            'preheader' => $preheader,
            'subject' => $subject,
            'prenomNom' => $prenomNom,
            'pseudo' => $pseudo,
            'image' => $image,
            'link' => $link
        ]);

        $headers =
            'Content-type: text/html'."\r\n".
            'Content-Transfer-Encoding: 8bit'."\r\n".
            'From: Blog de Thibaut Tourte <contact@thibaut-tourte.com>'."\r\n".
            'Reply-To: ' . $email;

        if (mail($email, $subject, $content, $headers) === true) {
            return true;
        }
        return false;
    }
}
