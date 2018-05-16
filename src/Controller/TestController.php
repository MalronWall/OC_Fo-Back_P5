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

        if ($_SERVER['SERVER_NAME']=='localhost') {
            ini_set('SMTP', 'smtp.sfr.fr');
            ini_set('sendmail_from', 'thibaut.tourte@sfr.fr');
        }

        $_POST['firstname'] = 'Thibaut';
        $_POST['lastname'] = 'Tourte';
        $_POST['email'] = 'thibaut.tourte17@gmail.com';
        $_POST['subject'] = 'Le sujet du mail';

        $title = $_POST['firstname'].' '.$_POST['lastname'].'<br/>'.
            htmlspecialchars('<'.$_POST['email'].'>');

        $message = 'Juste du texte pour combler le trou qu\'il y a !';

        $headers =
            'Content-type: text/html' ."\r\n".
            'From: ' . $_POST['email'] . "\r\n" .
            'Reply-To: ' . $_POST['email'];

        $content = $this->render('/mails/content.html.twig', [
            'title' => $title,
            'image' => 'contact.jpg',
            'content' => $message,
            'link' => ''
        ]);

//        if (mail("thibaut.tourte17@gmail.com", $_POST['subject'], $content, $headers) === true) {
//            return true;
//        }
//        return false;

        return $this->render('/mails/content.html.twig', [
            'title' => $title,
            'image' => 'contact.jpg',
            'content' => $message,
            'link' => ''
        ]);

//        if ($_SERVER['SERVER_NAME']=='localhost') {
//            ini_set('SMTP', 'smtp.sfr.fr');
//            ini_set('sendmail_from', 'thibaut.tourte@sfr.fr');
//        }
//
//        $content = file_get_contents(__DIR__."/../../templates/mails/layout.html.twig");
//
//        $headers =
//            'Content-type: text/html' ."\r\n".
//            'From: Blog Thibaut Tourte <thibaut.tourte17@gmail.com>';
//        if (mail("morvan.aurelien@gmail.com", "Sujet test mail", $content, $headers) === true) {
//            return $this->render('/mails/reset_password.html.twig', [
//                'title' => 'Reset password'
//            ]);
//        } else {
//            return 0;
//        }
    }
}
