<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Blog\Helper\MailHelper;
use Blog\Helper\RenameHelper;
use Blog\Helper\SecurityHelper;
use Blog\Helper\UserHelper;
use Blog\Manager\CommentManager;
use Blog\Manager\ImageManager;
use Blog\Manager\PostManager;
use Blog\Manager\RoleManager;
use Blog\Manager\UserManager;
use Core\Application\Controller\AbstractController;
use Core\Application\Exception\AccessDeniedException;
use Core\Application\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    protected $userHelper;
    protected $userManager;
    protected $roleManager;
    protected $commentManager;
    protected $imageManager;
    protected $securityHelper;
    protected $mailHelper;
    protected $renameHelper;
    protected $postManager;
    protected $errorController;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userHelper = new UserHelper();
        $this->securityHelper = new SecurityHelper();
        $this->userManager = new UserManager();
        $this->roleManager = new RoleManager();
        $this->imageManager = new ImageManager();
        $this->mailHelper = new MailHelper();
        $this->renameHelper = new RenameHelper();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->errorController = new ErrorController();
    }

    /**
     *
     */
    public function login()
    {
        $this->userHelper->loginProcess($this->userManager, $this->imageManager, $this->roleManager);
    }

    /**
     *
     */
    public function logon()
    {
        $this->userHelper->logonProcess(
            $this->userManager,
            $this->renameHelper,
            $this->securityHelper,
            $this->mailHelper
        );
    }

    /**
     *
     */
    public function logout()
    {
        $this->userHelper->logoutProcess();
    }

    /**
     * @param $token
     */
    public function confirmEmail($token)
    {
        $this->userHelper->confirmEmailProcess($this->userManager, $token, $this->errorController);
    }

    /**
     * @param $pseudo
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function profile($pseudo)
    {
        $profile =
            $this->userHelper->profileProcess(
                $this->userManager,
                $this->imageManager,
                $this->roleManager,
                $this->renameHelper,
                $pseudo,
                $this->errorController
            );

        return $this->render('profile.html.twig', [
            'title' => 'Profil',
            'profile' => $profile
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function admin()
    {
        $arrayAdmin =
            $this->userHelper->adminProcess(
                $this->userManager,
                $this->postManager,
                $this->commentManager,
                $this->roleManager,
                $this->errorController
            );
        
        return $this->render('admin.html.twig', [
            'title' => 'Espace admin',
            'users' => $arrayAdmin["users"],
            'nbUsers' => $arrayAdmin["nbUsers"],
            'posts' => $arrayAdmin["posts"],
            'nbPosts' => $arrayAdmin["nbPosts"],
            'comments' => $arrayAdmin["comments"],
            'nbComments' => $arrayAdmin["nbComments"]
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function resetPassword()
    {
        $error = $this->userHelper->resetPasswordProcess($this->userManager, $this->securityHelper, $this->mailHelper);

        return $this->render('reset_password.html.twig', [
            'title' => 'Réinitialiser le mot de passe',
            'error' => $error
        ]);
    }

    /**
     * @param $token
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function newPassword($token)
    {
        $error = $this->userHelper->newPasswordProcess($this->userManager, $token, $this->errorController);

        return $this->render('new_password.html.twig', [
           'title' => 'Nouveau mot de passe',
            'token' => $token,
            'error' => $error
        ]);
    }
}
