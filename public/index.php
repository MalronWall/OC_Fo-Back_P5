<?php

require '../vendor/autoload.php';

use Blog\Controller\ErrorController;
use Core\Application\Routing\Router;

session_start();

$url = isset($_GET['url']) ?  $url = $_GET['url'] : '/';
$router = new Router($url);

require_once "../etc/config/routing/routes.php";

try {
    echo $router->run();
} catch (\PDOException $e) {
    $errorController = new ErrorController();
    echo $errorController->internalError(
        "An error has occurred in AbstractManager.php->loadDatabase() : " . $e->getMessage()
    );
} catch (\Twig_Error $e) {
    $errorController = new ErrorController();
    echo $errorController->internalError(
        "An error has occurred in AbstractController.php->render() : " . $e->getMessage()
    );
} catch (\Exception $e) {
    $errorController = new ErrorController();
    echo $this->errorController->internalError("An error has occurred in index.php->run() : " . $e->getMessage());
}
