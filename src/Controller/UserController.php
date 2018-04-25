<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class UserController extends AbstractController
{
    public function connection()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod == 'POST') {
            $post = $_POST;
            if ($this->contactHelper->processContactForm($post) === true) {
                $this->addFlash('success', 'Message envoyé !');
            } else {
                $this->addFlash('danger', 'Problème robotique !');
            }
        }

        return $this->render('login.html.twig', [
            'title' => 'Connexion'
        ]);
    }

    public function login()
    {

    }

    public function logon()
    {
        $token = md5(uniqid(mt_rand(), true));
    }
}
