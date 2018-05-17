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
        $preheader = 'Plus qu\'une étape pour finaliser l\'inscription !';
        $image = 'inscription.jpg';

        $subject = 'Confirmation d\'inscription';
        $prenomNom = 'Thibaut Tourte';
        $pseudo = 'MalronWall';
        $email = 'thibaut.tourte17@gmail.com';

        $link = 'confirm-email/zef2z1rfazef6aze2';

        return $this->render('/mails/confirmLogon.html.twig', [
            'preheader' => $preheader,
            'subject' => $subject,
            'prenomNom' => $prenomNom,
            'pseudo' => $pseudo,
            'image' => $image,
            'link' => $link
        ]);
    }
}
