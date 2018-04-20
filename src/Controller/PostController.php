<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Blog\Helper\PaginatorHelper;
use Blog\Manager\CommentManager;
use Blog\Manager\UserManager;
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

        $userManager = new UserManager();
        //var_dump($posts);
        /*foreach ($posts as $post) {
            foreach ($post as $field => $value) {
                echo $field . " => " . $value . "<br/>";
                if ($field == "id_User") {
                    $posts["pseudoUser"] = $userManager->getUser($value);
                }
            }
        }*/
        //exit();
        $paginatorHelper = new PaginatorHelper($posts, $id, 5);
        $pagination = $paginatorHelper->getPaging();

        return $this->render('posts.html.twig', [
            'title' => 'Articles',
            'pagination' => $pagination
        ]);
    }

    public function show($slugPost)
    {
        return $this->showPage($slugPost, 1);
    }

    public function showPage($slugPost, $id)
    {
        $post = $this->postManager->getPost($slugPost);

        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($slugPost);

        $paginatorHelper = new PaginatorHelper($comments, $id, 10);
        $pagination = $paginatorHelper->getPaging();

        return $this->render('posts-show.html.twig', [
            'title' => 'Article',
            'post' => $post,
            'pagination' => $pagination
        ]);
    }
}
