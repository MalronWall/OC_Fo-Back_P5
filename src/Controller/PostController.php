<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Blog\Helper\PaginatorHelper;
use Blog\Helper\RenameHelper;
use Blog\Manager\CommentManager;
use Blog\Manager\ImageManager;
use Blog\Manager\UserManager;
use Core\Application\Controller\AbstractController;
use Blog\Manager\PostManager;
use Core\Application\Exception\AccessDeniedException;
use Core\Application\Exception\NotFoundHttpException;

class PostController extends AbstractController
{
    private $postManager;
    private $userManager;
    private $imageManager;
    private $commentManager;
    private $paginatorHelper;
    private $errorController;
    private $renameHelper;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
        $this->imageManager = new ImageManager();
        $this->commentManager = new CommentManager();
        $this->paginatorHelper = new PaginatorHelper();
        $this->errorController = new ErrorController();
        $this->renameHelper = new RenameHelper();
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

        $pagination = $this->paginatorHelper->getPaging($posts, $id, 5);

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
        try {
            if ($post == false) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            return $this->errorController->notFound();
        }
        // Remplacement de l'idUser par User dans Post
        $this->userManager->replaceIdByUser($post);
        // Remplacement de l'idImage par Image dans User
        $this->imageManager->replaceIdUserByImage($post->getUser());

        // Récup des commentaires
        $comments = $this->commentManager->getValidComments($post->getId());
        // Remplacement de l'idUser par User dans Comment
        $this->userManager->replaceIdsByUsers($comments);
        // Remplacement de l'idImage par Image dans User
        foreach ($comments as $comment) {
            $this->imageManager->replaceIdUserByImage($comment->getUser());
        }

        $pagination = $this->paginatorHelper->getPaging($comments, $id, 10);

        // CREATION D'UN NOUVEAU COMMENTAIRE
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_SESSION['user']) && !empty($_POST['commentContent'])) {
                if ($this->commentManager->createComment(
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

    public function newPost()
    {
        try {
            if (!isset($_SESSION['user']) or $_SESSION['user'][9][0] == 3) {
                throw new AccessDeniedException();
            }
        } catch (AccessDeniedException $e) {
            return $this->errorController->accessDenied();
        }

        $post = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (iconv_strlen($post['title'])>=4 &&
                iconv_strlen($post['title'])<=25 &&
                iconv_strlen($post['content'])>=50) {
                // CHECK TITLE
                if ($this->postManager->checkTitle($post['title'])[0] == 0) {
                    // RENAME TITLE TO SLUG
                    $slug = $this->renameHelper->renameTitleInSlug($post['title']);
                    // CHECK SLUG
                    if ($this->postManager->checkSlug($slug)[0] == 0) {
                        // CREATE NEW POST
                        if ($this->postManager->createPost($post, $slug, $_SESSION['user'][0])) {
                            // CHAPO
                            if (!empty($post['chapo'])) {
                                if (iconv_strlen($post['chapo']) <= 100) {
                                    if ($this->postManager->updateChapo($slug, $post['chapo']) != true) {
                                        $this->addFlash("danger", "
                                        Une erreur est survenue lors de l'enregistrement du chapo ! 
                                        Veuillez réessayer ! :(
                                        ");
                                    }
                                } else {
                                    $this->addFlash("danger", "
                                    Les tailles requises du chapo n'ont pas été respectées ! Veuillez réessayer ! :(
                                    ");
                                }
                            }
                            // IMAGE
                            if (!empty($_FILES['uploadImage']['name'])) {
                                if ($_FILES['uploadImage']['error'] == 0) {
                                    $extensions = array('.png', '.jpg', '.jpeg');
                                    $extension = strrchr($_FILES['uploadImage']['name'], '.');
                                    if (in_array($extension, $extensions)) {
                                        if ($_FILES['uploadImage']['size'] < 1000000) {
                                            if ($this->renameHelper->moveImagePostUploaded(
                                                $_FILES['uploadImage']['tmp_name'],
                                                $slug
                                            )) {
                                                $newPost = $this->postManager->getPostBySlug($slug);
                                                $this->imageManager->createAndLinkImagePost($newPost->getId());
                                            }
                                        } else {
                                            $this->addFlash("warning", "
                                            La taille de l'image est trop grande ! :/
                                            ");
                                        }
                                    } else {
                                        $this->addFlash("warning", "
                                        Le fichier envoyé n'est pas un format d'image accepté ! :/
                                        ");
                                    }
                                }
                            }
                            // SUCCESS
                            $this->addFlash("success", "
                                La création de l'article est un succès ! :)
                                ");
                            $this->redirect('posts/' . $slug);
                        } else {
                            $this->addFlash("danger", "
                                Une erreur est survenue lors de l'enregistrement de l'article ! Veuillez réessayer ! :(
                                ");
                        }
                    } else {
                        $this->addFlash("warning", "
                            Ce titre possède une correspondance avec un autre article ! Veuillez en changer ! :/
                            ");
                    }
                } else {
                    $this->addFlash("warning", "
                        Ce titre existe déjà ! Veuillez en changer ! :/
                        ");
                }
            } else {
                $this->addFlash("danger", "
                    Les tailles requises du titre et/ou du contenu n'ont pas été respectées ! Veuillez réessayer ! :(
                    ");
            }
        }

        return $this->render('posts-admin.html.twig', [
            'title' => 'Nouvel article',
            'post' => $post
        ]);
    }

    public function editPost($slug)
    {
        try {
            if (!isset($_SESSION['user']) or $_SESSION['user'][9][0] == 3) {
                throw new AccessDeniedException();
            }
        } catch (AccessDeniedException $e) {
            return $this->errorController->accessDenied();
        }

        $currentPost = $this->postManager->getPostBySlug($slug);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (iconv_strlen($post['title'])>=4 &&
                iconv_strlen($post['title'])<=25 &&
                iconv_strlen($post['content'])>=50) {
                $lastUpdate = 0;
                // UPDATE TITLE & SLUG
                if ($post['title'] != $currentPost->getTitle()) {
                    if ($this->postManager->checkTitle($post['title'])[0] == 0) {
                        $oldSlug = $slug;
                        $slug = $this->renameHelper->renameTitleInSlug($post['title']);
                        if ($this->postManager->checkSlug($slug)[0] == 0) {
                            if ($this->postManager->updateSlugTitle($oldSlug, $slug, $post['title'])) {
                                $lastUpdate = 1;
                            } else {
                                $this->addFlash("danger", "
                                Une erreur s'est produite lors de la mise à jour du titre ! :(
                                ");
                            }
                        } else {
                            $this->addFlash("warning", "
                            Ce titre possède une correspondance avec un autre article ! Veuillez en changer ! :/
                            ");
                        }
                    } else {
                        $this->addFlash("warning", "
                        Ce titre existe déjà ! Veuillez en changer ! :/
                        ");
                    }
                }
                // UPDATE CONTENT
                if ($post['content'] != $currentPost->getContent()) {
                    if ($this->postManager->updateContent($slug, $post['content'])) {
                        $lastUpdate = 1;
                    } else {
                        $this->addFlash("danger", "
                        Une erreur s'est produite lors de la mise à jour du contenu ! :(
                        ");
                    }
                }
                // UPDATE CHAPO
                if (!empty($post['chapo'])) {
                    if (iconv_strlen($post['chapo']) <= 100) {
                        if ($post['chapo'] != $currentPost->getChapo()) {
                            if ($this->postManager->updateChapo($slug, $post['chapo']) != true) {
                                $this->addFlash("danger", "
                                    Une erreur est survenue lors de l'enregistrement du chapo ! 
                                    Veuillez réessayer ! :(
                                    ");
                                $lastUpdate = 1;
                            }
                        }
                    } else {
                        $this->addFlash("danger", "
                        Les tailles requises du chapo n'ont pas été respectées ! Veuillez réessayer ! :(
                        ");
                    }
                }
                // UPDATE IMAGE
                if (!empty($_FILES['uploadImage']['name'])) {
                    if ($_FILES['uploadImage']['error'] == 0) {
                        $extensions = array('.png', '.jpg', '.jpeg');
                        $extension = strrchr($_FILES['uploadImage']['name'], '.');
                        if (in_array($extension, $extensions)) {
                            if ($_FILES['uploadImage']['size'] < 1000000) {
                                if ($this->renameHelper->moveImagePostUploaded(
                                    $_FILES['uploadImage']['tmp_name'],
                                    $slug
                                )) {
                                    $newPost = $this->postManager->getPostBySlug($slug);
                                    $this->imageManager->createAndLinkImagePost($newPost->getId());
                                    $lastUpdate = 1;
                                }
                            } else {
                                $this->addFlash("warning", "
                                    La taille de l'image est trop grande ! :/
                                    ");
                            }
                        } else {
                            $this->addFlash("warning", "
                                Le fichier envoyé n'est pas un format d'image accepté ! :/
                                ");
                        }
                    }
                }
                // UPDATE LASTUPDATE
                if ($lastUpdate == 1) {
                    if ($this->postManager->updateLastUpdate($slug) == true) {
                        $this->addFlash("success", "
                            L'édition de l'article est un succès ! :)
                            ");
                        $this->redirect('posts/' . $slug);
                    } else {
                        $this->addFlash("danger", "
                            Une erreur est survenue lors de la mise à jour de la date ! :(
                            ");
                    }
                }
            } else {
                $this->addFlash("danger", "
                    Les tailles requises n'ont pas été respectées ! Veuillez réessayer ! :(
                    ");
            }
        }

        $title = $currentPost->getTitle();

        return $this->render('posts-admin.html.twig', [
            'title' => 'Edition de '.$title,
            'post' => $currentPost
        ]);
    }

    public function deletePost($slug)
    {
        try {
            if (!isset($_SESSION['user']) or $_SESSION['user'][9][0] == 3) {
                throw new AccessDeniedException();
            }
        } catch (AccessDeniedException $e) {
            return $this->errorController->accessDenied();
        }

        if ($this->postManager->getPostBySlug($slug) != false) {
            if ($this->postManager->deletePost($slug)) {
                $this->addFlash("success", "
                L'article a été supprimé avec succès ! :)
                ");
            } else {
                $this->addFlash("danger", "
                Une erreur s'est produite, veuillez réessayer ! :(
                ");
            }
        } else {
            $this->addFlash("danger", "
                Cet article n'existe pas ! :(
                ");
        }

        $this->redirect('posts');
    }
}
