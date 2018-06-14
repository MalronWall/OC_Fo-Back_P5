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
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home()
    {
        return $this->render('home.html.twig', [
            'title' => 'Accueil'
        ]);
    }
}
