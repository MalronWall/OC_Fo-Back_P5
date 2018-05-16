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

    public function contact()
    {
        $post = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if ((!empty($post['firstname']) && !empty($post['lastname']) && !empty($post['email'])
                && !empty($post['subject']) && !empty($post['content']))) {
                if ($this->contactHelper->processContactForm($post) === true) {
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

        return $this->render('contact.html.twig', [
            'title' => 'Contact',
            'post' => $post
        ]);
    }
}
