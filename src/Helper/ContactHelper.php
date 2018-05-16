<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

class ContactHelper
{
    private $mailHelper;

    public function __construct()
    {
        $this->mailHelper = new MailHelper();
    }

    public function processContactForm(array $post)
    {
        $valide = false;
        if ($_SERVER['SERVER_NAME']!='localhost') {
            $key = "6Lc0YlMUAAAAACFxZtZIVuCg1E0NczBo2jjYV8tF";
            $response = $_POST['g-recaptcha-response'];
            $userIp = $_SERVER['REMOTE_ADDR'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $key
                . "&response=" . $response
                . "&remoteip=" . $userIp;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true) {
                $valide = $this->mailHelper->sendMailContact($post);
            }
            return $valide;
        }
        $valide = $this->mailHelper->sendMailContact($post);
        return $valide;
    }

    public function sendMail(array $post)
    {
        if ($_SERVER['SERVER_NAME']=='localhost') {
            ini_set('SMTP', 'smtp.sfr.fr');
            ini_set('sendmail_from', 'thibaut.tourte@sfr.fr');
        }

        $content =
            '-----------------------------------------------------
            <h2>Message envoyé à partir du formulaire de votre blog :</h2>
            <h3>Message de <strong>'.$post['firstname'].' '.$post['lastname'].'</strong> '.
            htmlspecialchars('<').$post['email'].htmlspecialchars('>').'<br/>
            -----------------------------------------------------<br/><br/>
            <h3>'.$post['subject'].'</h3><br/>'.
            nl2br($post['content']);

        $headers =
            'Content-type: text/html' ."\r\n".
            'From: ' . $post['email'] . "\r\n" .
            'Reply-To: ' . $post['email'];
        if (mail("thibaut.tourte17@gmail.com", $post['subject'], $content, $headers) === true) {
            return true;
        }
        return false;
    }
}
