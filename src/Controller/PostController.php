<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;

class PostController extends AbstractController
{
    public function list()
    {
        return $this->render('posts.html.twig');
    }

    public function show($id)
    {
        echo "Le détail du post $id fonctionne !";
    }

    public function showSlug($slug, $id)
    {
        echo "Le détail du post $slug / $id fonctionne !";
    }
}
