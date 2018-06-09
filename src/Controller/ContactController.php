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
    protected $contactHelper;
    
    public function __construct()
    {
        parent::__construct();
        $this->contactHelper = new ContactHelper();
    }

    /**
     * @return string
     */
    public function contact()
    {
        $post = $this->contactHelper->ContactForm();

        return $this->render('contact.html.twig', [
            'title' => 'Contact',
            'post' => $post
        ]);
    }
}
