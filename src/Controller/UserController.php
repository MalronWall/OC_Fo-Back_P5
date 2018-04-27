<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Blog\Helper\MailHelper;
use Blog\Helper\SecurityHelper;
use Blog\Manager\ImageManager;
use Blog\Manager\UserManager;
use Core\Application\Controller\AbstractController;

class UserController extends AbstractController
{
    protected $securityHelper;
    protected $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->securityHelper = new SecurityHelper();
        $this->userManager = new UserManager();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            $checkEmail = array_values($this->userManager->checkEmailPseudo($post));
            if ($checkEmail[0] == 1) {
                $user = $this->userManager->checkUser($post);
                if ($user != false) {
                    $imageManager = new ImageManager();
                    $imageManager->replaceIdUserByImage($user);
                    $user->setImage($user->getImage()[0]->serialize());
                    $_SESSION['user'] = $user->serialize();
                    $this->addFlash("success", "
                    Vous êtes maintenant connecté ! :)
                    ");
                } else {
                    $this->addFlash("danger", "
                    Votre mot de passe semble erroné, veuillez réessayer ! :/
                    ");
                }
            } else {
                $this->addFlash("danger", "
                    Votre identifiant ne correspond à aucun de nos utilisateurs... :(
                    ");
            }
        }

        //header("location: ' . __DIR__ . '\..\..\public");
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $this->redirect('\..\..\public');
        } else {
            $this->redirect('\\');
        }
    }

    public function logon()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                if ($post['password'] == $post['confPassword']) {
                    $checkEmail = array_values($this->userManager->checkEmail($post));
                    if ($checkEmail[0] == 0) {
                        $checkPseudo = array_values($this->userManager->checkPseudo($post));
                        if ($checkPseudo[0] == 0) {
                            $token = $this->securityHelper->generateToken();
                            if ($this->userManager->createUser($post, $token) == true) {
                                $mailHelper = new MailHelper();
                                $mailHelper->sendMailNewUser($post, $token);
                                $this->addFlash("warning", "
                                Pour finir de vous inscrire, veuillez cliquer sur le lien reçu par mail ! :)
                                ");
                            } else {
                                $this->addFlash("danger", "
                                Une erreur s'est produite lors de la création de votre profil, veuillez réessayer ! :/
                                ");
                            }
                        } else {
                            $this->addFlash("danger", "
                            Ce pseudo existe déjà ! :/
                            ");
                        }
                    } else {
                        $this->addFlash("danger", "
                            Cette adresse email existe déjà ! :/
                            ");
                    }
                } else {
                    $this->addFlash("danger", "
                    Les deux mots de passe entrés ne sont pas identiques !
                    ");
                }
            } else {
                $this->addFlash("danger", $post['email'] .
                    " n'est pas une adresse mail valide !
                    ");
            }
        }

        //header("location: ' . __DIR__ . '\..\..\public");
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $this->redirect('\..\..\public');
        } else {
            $this->redirect('\\');
        }
    }

    public function logout()
    {
        session_destroy();
        session_start();
        $this->addFlash("info", "A bientôt ! :)");
        //header("location: ' . __DIR__ . '\..\..\public");
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $this->redirect('\..\..\public');
        } else {
            $this->redirect('\\');
        }
    }

    public function confirmEmail($token)
    {
        $checkToken = array_values($this->userManager->checkToken($token));
        if ($checkToken[0] == 1) {
            $this->userManager->deleteToken($token);
            $this->addFlash("success", "
                Félicitations ! Votre adresse mail vient d'être validée et vous pouvez désormais vous connecter ! :)
                ");
        } else {
            $this->redirect('404');
        }

        $this->redirect('');
    }
}
