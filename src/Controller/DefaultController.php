<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 19:30
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function home()
    {
        return $this->render('home.html.twig', [
            'title' => 'Accueil'
        ]);
    }
}
