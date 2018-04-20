<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

class ContactHelper
{
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
                if ($this->sendMail($post) === true) {
                    $valide = true;
                }
            }
            return $valide;
        }
        if ($this->sendMail($post) === true) {
            $valide = true;
        }
        return $valide;
    }

    public function sendMail(array $post)
    {
        if ($_SERVER['SERVER_NAME']=='localhost') {
            ini_set('SMTP', 'smtp.sfr.fr');
            ini_set('sendmail_from', 'thibaut.tourte@sfr.fr');
        }

        $content = "Message envoyé à partir du formulaire de votre blog :
Message de ".$post['firstname']." ".$post['firstname']." <".$post['email'].

$post['content'];
        if (mail("thibaut.tourte17@gmail.com", $post['subject'], $content) === true) {
            return true;
        }
        return false;
    }
}
