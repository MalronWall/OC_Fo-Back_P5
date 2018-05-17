<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Controller;

use Blog\Helper\MailHelper;
use Blog\Helper\RenameHelper;
use Blog\Helper\SecurityHelper;
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
    protected $userManager;
    protected $roleManager;
    protected $commentManager;
    protected $imageManager;
    protected $securityHelper;
    protected $mailHelper;
    protected $renameHelper;
    protected $postManager;
    protected $errorController;

    public function __construct()
    {
        parent::__construct();
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

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            $checkEmail = array_values($this->userManager->checkEmailPseudo($post));
            if ($checkEmail[0] == 1) {
                $checkTokenLogon = array_values($this->userManager->checkTokenLogonByUser($post));
                if ($checkTokenLogon[0] == 0) {
                    $checkBlocked = array_values($this->userManager->checkBlocked($post));
                    if ($checkBlocked[0] == 0) {
                        $user = $this->userManager->checkUser($post);
                        if ($user != false) {
                            $this->roleManager->replaceIdByRole($user);
                            $user->setRole($user->getRole()->serialize());
                            $this->imageManager->replaceIdUserByImage($user);
                            if (!empty($user->getImage())) {
                                $user->setImage($user->getImage()[0]->serialize());
                            }
                            $this->userManager->deleteTokenForgotPwd($post);
                            $_SESSION['user'] = $user->serialize();
                            $this->addFlash("success", "
                            Vous êtes maintenant connecté ! :)
                            ");
                        } elseif (array_values($this->userManager->checkTokenForgotPwdByUser($post))[0] == 1) {
                            $this->addFlash("danger", "
                            Votre mot de passe semble erroné 
                            malgré votre demande de récupération de mot de passe ! :/<br/>
                            Si vous avez perdu le mail, 
                            vous pouvez toujours en recevoir un autre en cliquant de nouveau sur 'Mot de passe oublié' ! :)
                            ");
                        } else {
                            $this->addFlash("danger", "
                            Votre mot de passe semble erroné, veuillez réessayer ! :/
                            ");
                        }
                    } else {
                        $this->addFlash("danger", "
                        Connexion impossible : votre compte a été suspendu ! :(
                        ");
                    }
                } else {
                    $this->addFlash("danger", "
                        Connexion impossible : vous n'avez pas confirmé votre compte ! :(
                        ");
                }
            } else {
                $this->addFlash("danger", "
                    Votre identifiant ne correspond à aucun de nos utilisateurs... :(
                    ");
            }
        }

        $this->redirect('');
    }

    public function logon()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;
            if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                if ($post['password'] == $post['confPassword']) {
                    $checkEmail = array_values($this->userManager->checkEmail($post));
                    if ($checkEmail[0] == 0) {
                        $post['pseudo'] = $this->renameHelper->renamePseudo($post['pseudo']);
                        $checkPseudo = array_values($this->userManager->checkPseudo($post));
                        if ($checkPseudo[0] == 0) {
                            $token = $this->securityHelper->generateToken();
                            if ($this->userManager->createUser($post, $token) == true) {
                                if ($this->mailHelper->sendMailConfirmationLogon($post, $token)) {
                                    $this->addFlash("warning", "
                                    Pour finir de vous inscrire, veuillez cliquer sur le lien reçu par mail ! :)
                                    ");
                                } else {
                                    $this->addFlash("danger", "
                                    Une erreur s'est produite lors de l'envoi du mail de confirmation ! 
                                    Veuillez nous contacter via le formulaire ! :(
                                    ");
                                }
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

        $this->redirect('');
    }

    public function logout()
    {
        session_destroy();
        session_start();
        $this->addFlash("info", "A bientôt ! :)");

        $this->redirect('');
    }

    public function confirmEmail($token)
    {
        $checkToken = array_values($this->userManager->checkTokenLogonByToken($token));
        try {
            if ($checkToken[0] == 0) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            return $this->errorController->notFound();
        }
        
        $this->userManager->deleteTokenLogon($token);
        $this->addFlash("success", "
            Félicitations ! Votre adresse mail vient d'être validée et vous pouvez désormais vous connecter ! :)
            ");

        $this->redirect('');
    }
    
    public function profile($pseudo)
    {
        // Modifications des données du profil
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['lastname']) &&
                !empty($_POST['firstname']) &&
                !empty($_POST['pseudo']) &&
                !empty($_POST['email'])
            ) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_POST['pseudo'] = $this->renameHelper->renamePseudo($_POST['pseudo']);
                    if ($this->userManager->updateDatas($_POST, $_SESSION['user'][0])) {
                        if (!empty($_FILES['uploadImage']['name'])) {
                            if ($_FILES['uploadImage']['error'] == 0) {
                                $extensions = array('.png', '.jpg', '.jpeg');
                                $extension = strrchr($_FILES['uploadImage']['name'], '.');
                                if (in_array($extension, $extensions)) {
                                    if ($_FILES['uploadImage']['size'] < 700000) {
                                        if ($this->renameHelper->moveImageUserUploaded(
                                            $_FILES['uploadImage']['tmp_name'],
                                            $_POST['pseudo']
                                        )) {
                                            $newImage = $this->imageManager->createAndLinkImageUser($_SESSION['user'][0]);
                                            if (is_object($newImage)) {
                                                $_SESSION['user'][9] = $newImage->serialize();
                                            }
                                        }
                                    } else {
                                        $this->addFlash("warning", "
                                        Les données personnelles ont été mises à jour mais 
                                        la taille de l'image est trop grande ! :/
                                        ");
                                    }
                                } else {
                                    $this->addFlash("warning", "
                                        Les données personnelles ont été mises à jour mais 
                                        le format du fichier envoyé n'est pas une image ! :/
                                        ");
                                }
                            }
                        }
                        if (!empty($_POST['password'])) {
                            if ($_POST['password'] == $_POST['confPassword']) {
                                if ($this->userManager->updatePassword($_POST['password'], $_SESSION['user'][0])) {
                                    $this->addFlash("success", "
                                    Les données personnelles et le mot de passe ont été mis à jour ! :)
                                    ");
                                } else {
                                    $this->addFlash("danger", "
                                    Une erreur est survenue lors de la modification du mot de passe, veuillez réessayer ! :/
                                    ");
                                }
                            } else {
                                $this->addFlash("warning", "
                                Les données personnelles ont été mises à jour 
                                mais les deux mots de passe ne correspondaient pas ! :/
                                ");
                            }
                        }
                        // Renommage de l'image par le nouveau pseudo
                        $this->renameHelper->renameImageUser($_SESSION['user'][1], $_POST['pseudo']);

                        // Mise à jour des variables de la SESSION
                        $_SESSION['user'][1] = $_POST['pseudo'];
                        $_SESSION['user'][2] = $_POST['lastname'];
                        $_SESSION['user'][3] = $_POST['firstname'];
                        $_SESSION['user'][4] = $_POST['email'];

                        if (!isset($_SESSION['flashbag'])) {
                            $this->addFlash("success", "
                                    Les données personnelles ont été mises à jour ! :)
                                    ");
                        }

                        $this->redirect('members/' . $_POST['pseudo']);
                    } else {
                        $this->addFlash("danger", "
                        Une erreur est survenue lors de la modification des données, veuillez réessayer ! :/
                        ");
                    }
                } else {
                    $this->addFlash("danger", "
                        L'email entré ne possède pas le bon format, veuillez réessayer ! :/
                        ");
                }
            } else {
                $this->addFlash("danger", "
                Toutes les données personnelles doivent être complétées avant d'être envoyées ! :/
                ");
            }
        }

        $profile = $this->userManager->getProfile($pseudo);
        try {
            if ($profile == false) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            return $this->errorController->notFound();
        }

        $this->roleManager->replaceIdByRole($profile);

        return $this->render('profile.html.twig', [
            'title' => 'Profil',
            'profile' => $profile
        ]);
    }
    
    public function admin()
    {
        try {
            if (!isset($_SESSION['user']) or $_SESSION['user'][10][0] == 3) {
                throw new AccessDeniedException();
            }
        } catch (AccessDeniedException $e) {
            return $this->errorController->accessDenied();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {
                // explode the name
                $exploded = explode('_', $key);
                // Push the value at the end of the explode
                array_push($exploded, $value);
                // Redirect to the good SQL request via switch
                switch ($exploded[0]) {
                    case 'userBlocked':
                        $this->userManager->updateBlocked($exploded[1], $exploded[2]);
                        break;
                    case 'userRole':
                        $this->userManager->updateRole($exploded[1], $exploded[2]);
                        break;
                    case 'commentValid':
                        if ($exploded[2] == 1) {
                            $this->commentManager->validComment($exploded[1]);
                        } else {
                            $this->commentManager->deleteComment($exploded[1]);
                        }
                }
            }
            $this->addFlash("success", "Les données ont été mises à jour ! :)");
            $this->redirect('admin');
        }

        // Users
        $users = $this->userManager->getUsers();
        $this->roleManager->replaceIdsByRole($users);
        $nbUsers = count($users);

        // Posts
        $posts = $this->postManager->getPosts();
        $this->userManager->replaceIdsByUsers($posts);
        $nbPosts = count($posts);

        // Comments
        $comments = $this->commentManager->getPendingComments();
        $this->postManager->replaceIdsByPost($comments);
        $this->userManager->replaceIdsByUsers($comments);
        $nbComments = count($comments);
        
        return $this->render('admin.html.twig', [
            'title' => 'Espace admin',
            'users' => $users,
            'nbUsers' => $nbUsers,
            'posts' => $posts,
            'nbPosts' => $nbPosts,
            'comments' => $comments,
            'nbComments' => $nbComments
        ]);
    }
    
    public function resetPassword()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['email'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    if (array_values($this->userManager->checkEmail($_POST))[0] == 1) {
                        $token = $this->securityHelper->generateToken();
                        if ($this->userManager->updateTokenForgotPwd($_POST['email'], $token)) {
                            $user = $this->userManager->getUserByEmail($_POST['email']);
                            if ($this->mailHelper->sendMailForgotPassword($user)) {
                                $this->addFlash("success", "
                                    Le mail de réinitialisation du mot de passe a bien été envoyé ! :)
                                    ");
                                $this->redirect('');
                            } else {
                                $error = 'Une erreur est survenue lors de l\'envoi du mail, veuillez réessayer ! :/';
                            }
                        } else {
                            $error = 'Une erreur est survenue lors du paramètrage de la sécurité, veuillez réessayer ! :/';
                        }
                    } else {
                        $error = 'Cette adresse mail n\'existe pas ! :/';
                    }
                } else {
                    $error = "L'email entré ne possède pas le bon format, veuillez réessayer ! :/";
                }
            } else {
                $error = 'Veuillez renseigner au préalable votre adresse mail ! :(';
            }
        }

        return $this->render('reset_password.html.twig', [
            'title' => 'Réinitialiser le mot de passe',
            'error' => $error
        ]);
    }

    public function newPassword($token)
    {
        $checkToken = array_values($this->userManager->checkTokenForgotPwdByToken($token));
        try {
            if ($checkToken[0] == null) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            return $this->errorController->notFound();
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['password']) or !empty($_POST['confPassword'])) {
                if ($_POST['password'] == $_POST['confPassword']) {
                    if ($this->userManager->updatePasswordByToken($_POST['password'], $token)) {
                        $this->addFlash("success", "
                                    Le mot de passe a été correctement mis à jour ! :)
                                    ");
                        $this->redirect('');
                    } else {
                        $error = "Une erreur est survenue lors de la modification du mot de passe, 
                        veuillez réessayer ! :/";
                    }
                } else {
                    $error = "Les deux mots de passe ne correspondent pas ! :/";
                }
            } else {
                $error = "Tous les champs n'ont pas été renseignés ! :(";
            }
        }

        return $this->render('new_password.html.twig', [
           'title' => 'Nouveau mot de passe',
            'token' => $token,
            'error' => $error
        ]);
    }
}
