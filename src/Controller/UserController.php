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
                    $roleManager = new RoleManager();
                    $roleManager->replaceIdByRole($user);
                    $user->setRole($user->getRole()->serialize());
                    $imageManager = new ImageManager();
                    $imageManager->replaceIdUserByImage($user);
                    if (!empty($user->getImage())) {
                        $user->setImage($user->getImage()[0]->serialize());
                    }
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
    
    public function profile($pseudo)
    {
        // Modifications des données du profil
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['lastname']) &&
                !empty($_POST['firstname']) &&
                !empty($_POST['pseudo']) &&
                !empty($_POST['email'])
            ) {
                if ($this->userManager->updateDatas($_POST, $_SESSION['user'][0])) {
                    $renameHelper = new RenameHelper();
                    if (!empty($_FILES['uploadImage']['name'])) {
                        if ($_FILES['uploadImage']['error'] == 0) {
                            $extensions = array('.png', '.jpg', '.jpeg');
                            $extension = strrchr($_FILES['uploadImage']['name'], '.');
                            if (in_array($extension, $extensions)) {
                                if ($_FILES['uploadImage']['size'] < 700000) {
                                    if ($renameHelper->moveImageUserUploaded(
                                        $_FILES['uploadImage']['tmp_name'],
                                        $_POST['pseudo']
                                    )) {
                                        $imageManager = new ImageManager();
                                        $newImage = $imageManager->createAndLinkImageUser($_SESSION['user'][0]);
                                        if (is_object($newImage)) {
                                            $_SESSION['user'][8] = $newImage->serialize();
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
                            Les données personnelles ont été mises à jour mais les deux mots de passe ne correspondaient pas ! :/
                            ");
                        }
                    }
                    // Renommage de l'image par le nouveau pseudo
                    $renameHelper->renameImageUser($_SESSION['user'][1], $_POST['pseudo']);

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

                    $this->redirect('members/'.$_POST['pseudo']);
                } else {
                    $this->addFlash("danger", "
                    Une erreur est survenue lors de la modification des données, veuillez réessayer ! :/
                    ");
                }
            } else {
                $this->addFlash("danger", "
                Toutes les données personnelles doivent être complétées avant d'être envoyées ! :/
                ");
            }
        }

        $profile = $this->userManager->getProfile($pseudo);
        if ($profile == false) {
            $this->redirect('404');
        }
        $roleManager = new RoleManager();
        $roleManager->replaceIdByRole($profile);

        return $this->render('profile.html.twig', [
            'title' => 'Profil',
            'profile' => $profile
        ]);
    }
    
    public function admin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);
            foreach ($_POST as $post) {
                $exploded[] = explode('_', $post);
            }
            var_dump($exploded);
            exit();
        }

        $users = $this->userManager->getUsers();
        $roleManager = new RoleManager();
        $roleManager->replaceIdsByRole($users);
        
        $commentManager = new CommentManager();
        $comments = $commentManager->getPendingComments();
        $postManager = new PostManager();
        $postManager->replaceIdsByPost($comments);
        $this->userManager->replaceIdsByUsers($comments);
        $nbComments = count($comments);
        
        return $this->render('admin.html.twig', [
            'title' => 'Espace admin',
            'users' => $users,
            'comments' => $comments,
            'nbComments' => $nbComments
        ]);
    }
    
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['email'])) {
                
            }
        }
        
        return $this->render('reset_password.html.twig', [
            'title' => 'Réinitialiser le mot de passe'
        ]);
    }

    public function newPassword($token)
    {

    }
}
