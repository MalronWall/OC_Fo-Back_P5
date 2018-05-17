<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class TestController extends AbstractController
{
    public function mail()
    {
        $preheader = 'Un oubli de mot de passe ? On va arranger ça !';
        $image = 'motDePasse.jpg';

        $subject = 'Réinitialisation du mot de passe';
        $prenomNom = 'Thibaut Tourte';
        $pseudo = 'MalronWall';
        $email = 'thibaut.tourte17@gmail.com';

        $link = 'confirm-email/zef2z1rfazef6aze2';

        return $this->render('/mails/forgotPassword.html.twig', [
            'preheader' => $preheader,
            'subject' => $subject,
            'prenomNom' => $prenomNom,
            'pseudo' => $pseudo,
            'image' => $image,
            'link' => $link
        ]);
    }
}
