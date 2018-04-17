<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function notFound()
    {
        $domain = $_SERVER['SERVER_NAME'];
        return $this->render('404.html.twig', [
            'title' => '404',
            'domain' => $domain
        ]);
    }
}
