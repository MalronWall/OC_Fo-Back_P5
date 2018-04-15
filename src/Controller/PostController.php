<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Core\Application\Controller\AbstractController;
use Blog\Manager\PostManager;

class PostController extends AbstractController
{
    private $postManager;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager();
    }

    public function list()
    {
        $posts = $this->postManager->getPosts();
        return $this->render('posts.html.twig', [
            'posts' => $posts
        ]);
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
