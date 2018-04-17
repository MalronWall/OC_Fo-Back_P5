<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Blog\Helper\PaginatorHelper;
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
        return $this->listPage(1);
    }

    public function listPage($id)
    {
        $posts = $this->postManager->getPosts();
        $paginationObject = new PaginatorHelper($posts, $id);
        $pagination = $paginationObject->getPaging();

        return $this->render('posts.html.twig', [
            'title' => 'Articles',
            'pagination' => $pagination
        ]);
    }

    public function show($id)
    {
        echo "Le détail du post $id fonctionne !";
    }
}
