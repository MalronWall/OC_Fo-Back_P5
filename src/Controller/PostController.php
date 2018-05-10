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
    private $imageManager;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
        $this->imageManager = new ImageManager();
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
        // Remplacement de l'idImage par Image
        $this->imageManager->replaceIdsPostByImages($posts);

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
        // Récup du post avec le slug
        $post = $this->postManager->getPostBySlug($slugPost);
        if ($post == false) {
            $this->redirect('404');
        }
        // Remplacement de l'idUser par User dans Post
        $this->userManager->replaceIdByUser($post);
        // Remplacement de l'idImage par Image dans User
        $this->imageManager->replaceIdUserByImage($post->getUser());

        // Récup des commentaires
        $commentManager = new CommentManager();
        $comments = $commentManager->getValidComments($post->getId());
        // Remplacement de l'idUser par User dans Comment
        $this->userManager->replaceIdsByUsers($comments);
        // Remplacement de l'idImage par Image dans User
        foreach ($comments as $comment) {
            $this->imageManager->replaceIdUserByImage($comment->getUser());
        }

        $paginatorHelper = new PaginatorHelper($comments, $id, 10);
        $pagination = $paginatorHelper->getPaging();

        // CREATION D'UN NOUVEAU COMMENTAIRE
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_SESSION['user']) && !empty($_POST['commentContent'])) {
                $commentManager = new CommentManager();
                if ($commentManager->createComment(
                    $_POST['commentContent'],
                    $post->getId(),
                    $post->getUser()->getId()
                )) {
                    $this->addFlash("success", "
                    Votre commentaire à bien été envoyé ! Il sera visible lorsqu'un administrateur l'aura confirmé ! :)
                    ");
                } else {
                    $this->addFlash("danger", "
                    Une erreur s'est produite lors de la création de votre commentaire, veuillez réessayer ! :/
                    ");
                }
            }
        }

        return $this->render('posts-show.html.twig', [
            'title' => 'Article',
            'post' => $post,
            'pagination' => $pagination,
        ]);
    }
}
