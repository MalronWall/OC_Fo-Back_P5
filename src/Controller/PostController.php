<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 27/03/2018
 * Time: 18:25
 */

namespace Blog\Controller;

use Blog\Helper\PaginatorHelper;
use Blog\Helper\PostHelper;
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
    private $postHelper;
    private $paginatorHelper;
    private $renameHelper;
    private $errorController;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
        $this->imageManager = new ImageManager();
        $this->commentManager = new CommentManager();
        $this->postHelper = new PostHelper();
        $this->paginatorHelper = new PaginatorHelper();
        $this->renameHelper = new RenameHelper();
        $this->errorController = new ErrorController();
    }

    /**
     * @return string
     */
    public function list()
    {
        return $this->listPage(1);
    }

    /**
     * @param $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function listPage($id)
    {
        $pagination =
            $this->postHelper->listPageProcess(
                $this->postManager,
                $this->userManager,
                $this->imageManager,
                $this->paginatorHelper,
                $id
            );

        return $this->render('posts.html.twig', [
            'title' => 'Articles',
            'pagination' => $pagination,
        ]);
    }

    /**
     * @param $slugPost
     * @return array|string
     */
    public function show($slugPost)
    {
        return $this->showPage($slugPost, 1);
    }

    /**
     * @param $slugPost
     * @param $id
     * @return array|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showPage($slugPost, $id)
    {
        $arrayPage =
            $this->postHelper->showPageProcess(
                $this->postManager,
                $this->userManager,
                $this->imageManager,
                $this->commentManager,
                $this->paginatorHelper,
                $this->errorController,
                $slugPost,
                $id
            );

        if (is_string($arrayPage)) {
            return $arrayPage;
        }

        return $this->render('posts-show.html.twig', [
            'title' => 'Article',
            'post' => $arrayPage["post"],
            'pagination' => $arrayPage["pagination"],
        ]);
    }

    /**
     * @return array|int|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function newPost()
    {
        $post =
            $this->postHelper->newPostProcess(
                $this->postManager,
                $this->imageManager,
                $this->renameHelper,
                $this->errorController
            );

        if (is_string($post)) {
            return $post;
        }

        return $this->render('posts-admin.html.twig', [
            'title' => 'Nouvel article',
            'post' => $post
        ]);
    }

    /**
     * @param $slug
     * @return array|int|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editPost($slug)
    {
        $arrayPost =
            $this->postHelper->editPostProcess(
                $this->postManager,
                $this->imageManager,
                $this->renameHelper,
                $slug,
                $this->errorController
            );

        if (is_string($arrayPost)) {
            return $arrayPost;
        }

        return $this->render('posts-admin.html.twig', [
            'title' => 'Edition de '.$arrayPost["titlePost"],
            'post' => $arrayPost["currentPost"]
        ]);
    }

    /**
     * @param $slug
     * @return int|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function deletePost($slug)
    {
        return $this->postHelper->deletePostProcess($this->postManager, $slug, $this->errorController);
    }
}
