<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Blog\Helper\MailHelper;
use Core\Application\Controller\AbstractController;
use Blog\Helper\ContactHelper;

class ContactController extends AbstractController
{
    protected $contactHelper;
    protected $mailHelper;

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->contactHelper = new ContactHelper();
        $this->mailHelper = new MailHelper();
    }

    /**
     * @return string
     */
    public function contact()
    {
        $post = $this->contactHelper->ContactForm($this->mailHelper);

        return $this->render('contact.html.twig', [
            'title' => 'Contact',
            'post' => $post
        ]);
    }
}
