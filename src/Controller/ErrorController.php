<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class ErrorController extends AbstractController
{
    protected $domain;

    public function __construct()
    {
        parent::__construct();
        $this->domain = $_SERVER['SERVER_NAME'];
    }

    public function accessDenied()
    {
        return $this->render('403.html.twig', [
            'title' => '403',
            'domain' => $this->domain
        ]);
    }

    public function notFound()
    {
        return $this->render('404.html.twig', [
            'title' => '404',
            'domain' => $this->domain
        ]);
    }

    public function internalError($errorMessage = '')
    {
        return $this->render('500.html.twig', [
            'title' => '500',
            'domain' => $this->domain,
            'errorMessage' => $errorMessage
        ]);
    }
}
