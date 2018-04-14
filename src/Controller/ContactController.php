<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;
use Blog\Helper\ContactHelper;

class ContactController extends AbstractController
{
    private $contactHelper;

    public function __construct()
    {
        parent::__construct();
        $this->contactHelper = new ContactHelper();
    }

    public function contact()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod == 'POST') {
            $post = $_POST;
            $this->contactHelper->processContactForm($post);
            $this->addFlash('success', 'Message envoyé');
        }

        return $this->render('contact.html.twig');
    }
}
