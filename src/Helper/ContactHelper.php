<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Core\Application\Controller\AbstractController;

class ContactHelper extends AbstractController
{
    /**
     * @param MailHelper $mailHelper
     * @return array
     */
    public function contactForm(MailHelper $mailHelper)
    {
        $post = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if ((!empty($post['firstname']) && !empty($post['lastname']) && !empty($post['email'])
                && !empty($post['subject']) && !empty($post['content']))) {
                if ($this->processContactForm($post, $this->getParams()["keyReCaptcha"], $mailHelper) === true) {
                    $this->addFlash('success', 'Message envoyé !');
                    $post = [];
                } else {
                    $this->addFlash('danger', 'Un problème est survenu lors de 
                    l\'envoi du mail, veuillez réessayer !
                    ');
                }
            } else {
                $this->addFlash('danger', 'Un problème est survenu, veuillez réessayer !');
            }
        }
        return $post;
    }

    /**
     * @param array $post
     * @param $parameters
     * @param MailHelper $mailHelper
     * @return bool
     */
    public function processContactForm(array $post, $parameters, MailHelper $mailHelper)
    {
        $valide = false;
        if ($_SERVER['SERVER_NAME']!='localhost') {
            $key = $parameters;
            $response = $_POST['g-recaptcha-response'];
            $userIp = $_SERVER['REMOTE_ADDR'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $key
                . "&response=" . $response
                . "&remoteip=" . $userIp;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true) {
                $valide = $mailHelper->sendMailContact($post);
            }
            return $valide;
        }
        $valide = $mailHelper->sendMailContact($post);
        return $valide;
    }
}
