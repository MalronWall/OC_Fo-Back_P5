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
use Blog\Model\Post;
use Blog\Model\User;
use Core\Application\Controller\AbstractController;
use Blog\Manager\PostManager;

class PostController extends AbstractController
{
    private $postManager;

    /** @var UserManager */
    private $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
    }

    public function list()
    {
        return $this->listPage(1);
    }

    public function listPage($id)
    {
        $posts = $this->postManager->getPosts();
        $this->userManager->fetchAllPostsWithUser($posts);

        $paginatorHelper = new PaginatorHelper($posts, $id, 5);
        $pagination = $paginatorHelper->getPaging();

        return $this->render('posts.html.twig', [
            'title' => 'Articles',
            'pagination' => $pagination,
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
            'pagination' => $pagination,
        ]);
    }
}
