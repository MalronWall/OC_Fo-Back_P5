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
use Blog\Manager\ImageManager;
use Blog\Manager\UserManager;
use Blog\Model\Post;
use Blog\Model\User;
use Core\Application\Controller\AbstractController;
use Blog\Manager\PostManager;
use Core\Application\Exception\NotFoundHttpException;

class PostController extends AbstractController
{
    private $postManager;
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
        // Récup des posts
        $posts = $this->postManager->getPosts();
        // Remplacement de l'idUser par User
        $this->userManager->replaceIdsByUsers($posts);

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
        try {
            // Récup du post avec le slug
            $post = $this->postManager->getPost($slugPost);
        } catch (NotFoundHttpException $e) {
            $error = new ErrorController();
            return $error->notFound();
        }
        // Remplacement de l'idUser par User dans Post
        $this->userManager->replaceIdByUser($post);
        $imageManager = new ImageManager();
        // Remplacement de l'idImage par Image dans User
        $imageManager->replaceIdByImage($post->getUser());

        // Récup des commentaires
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($post->getId());
        // Remplacement de l'idUser par User dans Comment
        $this->userManager->replaceIdsByUsers($comments);
        // Remplacement de l'idImage par Image dans User
        foreach ($comments as $comment) {
            $imageManager->replaceIdByImage($comment->getUser());
        }

        $paginatorHelper = new PaginatorHelper($comments, $id, 10);
        $pagination = $paginatorHelper->getPaging();

        return $this->render('posts-show.html.twig', [
            'title' => 'Article',
            'post' => $post,
            'pagination' => $pagination,
        ]);
    }
}
