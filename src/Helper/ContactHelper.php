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
}
