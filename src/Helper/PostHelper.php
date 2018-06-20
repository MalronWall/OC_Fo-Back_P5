<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Blog\Controller\ErrorController;
use Blog\Manager\CommentManager;
use Blog\Manager\ImageManager;
use Blog\Manager\PostManager;
use Blog\Manager\UserManager;
use Core\Application\Controller\AbstractController;
use Core\Application\Exception\AccessDeniedException;
use Core\Application\Exception\NotFoundHttpException;

class PostHelper extends AbstractController
{
    /**
     * @param PostManager $postManager
     * @param UserManager $userManager
     * @param ImageManager $imageManager
     * @param PaginatorHelper $paginatorHelper
     * @param $id
     * @return array
     */
    public function listPageProcess(
        PostManager $postManager,
        UserManager $userManager,
        ImageManager $imageManager,
        PaginatorHelper $paginatorHelper,
        $id
    ) {
        $id = intval($id);
        // Récup des posts
        $posts = $postManager->getPosts();
        // Remplacement de l'idUser par User
        $userManager->replaceIdsByUsers($posts);
        // Remplacement de l'idImage par Image
        $imageManager->replaceIdsPostByImages($posts);

        return $paginatorHelper->getPaging($posts, $id, 5);
    }

    /**
     * @param PostManager $postManager
     * @param UserManager $userManager
     * @param ImageManager $imageManager
     * @param CommentManager $commentManager
     * @param PaginatorHelper $paginatorHelper
     * @param ErrorController $errorController
     * @param $slugPost
     * @param $id
     * @return array|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showPageProcess(
        PostManager $postManager,
        UserManager $userManager,
        ImageManager $imageManager,
        CommentManager $commentManager,
        PaginatorHelper $paginatorHelper,
        ErrorController $errorController,
        $slugPost,
        $id
    ) {
        // Récup du post avec le slug
        $post = $postManager->getPostBySlug($slugPost);
        try {
            if ($post == false) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            return $errorController->notFound();
        }
        // Remplacement de l'idUser par User dans Post
        $userManager->replaceIdByUser($post);
        // Remplacement de l'idImage par Image dans User
        $imageManager->replaceIdUserByImage($post->getUser());

        // Récup des commentaires
        $comments = $commentManager->getValidComments($post->getId());
        // Remplacement de l'idUser par User dans Comment
        $userManager->replaceIdsByUsers($comments);
        // Remplacement de l'idImage par Image dans User
        foreach ($comments as $comment) {
            $imageManager->replaceIdUserByImage($comment->getUser());
        }

        $pagination = $paginatorHelper->getPaging($comments, $id, 10);

        // CREATION D'UN NOUVEAU COMMENTAIRE
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_SESSION['user']) && !empty($_POST['commentContent'])) {
                if ($commentManager->createComment(
                    $_POST['commentContent'],
                    $post->getId(),
                    $_SESSION['user'][0]
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

        return [
          "post" => $post,
          "pagination" => $pagination
        ];
    }

    /**
     * @param PostManager $postManager
     * @param ImageManager $imageManager
     * @param RenameHelper $renameHelper
     * @param ErrorController $errorController
     * @return array|int|string
     */
    public function newPostProcess(
        PostManager $postManager,
        ImageManager $imageManager,
        RenameHelper $renameHelper,
        ErrorController $errorController
    ) {
        $err = $this->adminControl($errorController);
        if (is_string($err)) {
            return $err;
        }

        $post = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (iconv_strlen($post['title'])>=4 &&
                iconv_strlen($post['title'])<=25 &&
                iconv_strlen($post['content'])>=50) {
                // CHECK TITLE
                if ($postManager->checkTitle($post['title'])[0] == 0) {
                    // RENAME TITLE TO SLUG
                    $slug = $renameHelper->renameTitleInSlug($post['title']);
                    // CHECK SLUG
                    if ($postManager->checkSlug($slug)[0] == 0) {
                        // CREATE NEW POST
                        if ($postManager->createPost($post, $slug, $_SESSION['user'][0])) {
                            // CHAPO
                            if (!empty($post['chapo'])) {
                                if (iconv_strlen($post['chapo']) <= 100) {
                                    if ($postManager->updateChapo($slug, $post['chapo']) != true) {
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
                                            if ($renameHelper->moveImagePostUploaded(
                                                $_FILES['uploadImage']['tmp_name'],
                                                $slug
                                            )) {
                                                $newPost = $postManager->getPostBySlug($slug);
                                                $imageManager->createAndLinkImagePost($newPost->getId());
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

        return $post;
    }

    /**
     * @param PostManager $postManager
     * @param ImageManager $imageManager
     * @param RenameHelper $renameHelper
     * @param $slug
     * @param ErrorController $errorController
     * @return array|int|string
     */
    public function editPostProcess(
        PostManager $postManager,
        ImageManager $imageManager,
        RenameHelper $renameHelper,
        $slug,
        ErrorController $errorController
    ) {
        $err = $this->adminControl($errorController);
        if (is_string($err)) {
            return $err;
        }

        $currentPost = $postManager->getPostBySlug($slug);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (iconv_strlen($post['title'])>=4 &&
                iconv_strlen($post['title'])<=25 &&
                iconv_strlen($post['content'])>=50) {
                $lastUpdate = 0;
                // UPDATE TITLE & SLUG + IMAGE NAME
                if ($post['title'] != $currentPost->getTitle()) {
                    if ($postManager->checkTitle($post['title'])[0] == 0) {
                        $oldSlug = $slug;
                        $slug = $renameHelper->renameTitleInSlug($post['title']);
                        if ($postManager->checkSlug($slug)[0] == 0) {
                            if ($postManager->updateSlugTitle($oldSlug, $slug, $post['title'])) {
                                if ($renameHelper->renameImagePost($oldSlug, $slug)) {
                                    $lastUpdate = 1;
                                } else {
                                    $this->addFlash("danger", "
                                    Une erreur s'est produite lors du renommage de l'image ! :(
                                    ");
                                }
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
                    if ($postManager->updateContent($slug, $post['content'])) {
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
                            if ($postManager->updateChapo($slug, $post['chapo'])) {
                                $lastUpdate = 1;
                            } else {
                                $this->addFlash("danger", "
                                    Une erreur est survenue lors de l'enregistrement du chapo ! 
                                    Veuillez réessayer ! :(
                                    ");
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
                                if ($renameHelper->moveImagePostUploaded(
                                    $_FILES['uploadImage']['tmp_name'],
                                    $slug
                                )) {
                                    $newPost = $postManager->getPostBySlug($slug);
                                    $imageManager->createAndLinkImagePost($newPost->getId());
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
                    if ($postManager->updateLastUpdate($slug) == true) {
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

        return [
            "currentPost" => $currentPost,
            "titlePost" => $title
        ];
    }

    /**
     * @param PostManager $postManager
     * @param $slug
     * @param ErrorController $errorController
     * @return int|string
     */
    public function deletePostProcess(PostManager $postManager, $slug, ErrorController $errorController)
    {
        $err = $this->adminControl($errorController);
        if (is_string($err)) {
            return $err;
        }

        if ($postManager->getPostBySlug($slug) != false) {
            if ($postManager->deletePost($slug)) {
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

    /**
     * @param ErrorController $errorController
     * @return int|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function adminControl(ErrorController $errorController)
    {
        try {
            if (!isset($_SESSION['user']) or $_SESSION['user'][9][0] == 3) {
                throw new AccessDeniedException();
            }
        } catch (AccessDeniedException $e) {
            return $errorController->accessDenied();
        }

        return 0;
    }
}
