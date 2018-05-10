<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class MailHelper extends AbstractController
{
    

    public function sendMailNewUser($post, $token)
    {
        if ($_SERVER['SERVER_NAME']=='localhost') {
            ini_set('SMTP', 'smtp.sfr.fr');
            ini_set('sendmail_from', 'thibaut.tourte@sfr.fr');
        }

        $subject = 'Validation de la création du compte !';

        $content =
            '-----------------------------------------------------
            <h2>Message automatique envoyé de blog.thibaut-tourte.com</h2>
            <h3>Merci de ne pas y répondre</h3><br/>
            -----------------------------------------------------<br/><br/>
            <h3>'.$subject.'</h3><br/>'.
            $post['firstname'].' '.$post['lastname'].',<br/><br/>
            
            Afin de valider la création de votre compte, veuillez cliquer sur le lien suivant :<br/>
            blog.thibaut-tourte.com/confirm-email/'.$token.'<br/>
            ';

        $headers =
            'Content-type: text/html' ."\r\n".
            'From: blog.thibaut-tourte.com\r\n';
        if (mail($post['email'], $subject, $content, $headers) === true) {
            return true;
        }
        return false;
    }
}
