<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class UserController extends AbstractController
{
    public function login()
    {
        return $this->render('login.html.twig');
    }

    public function register()
    {
        $token = md5(uniqid(mt_rand(), true));
    }
}
