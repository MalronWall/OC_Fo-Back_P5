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
} catch (\Exception $e) {
    $errorController = new ErrorController();
    return $this->errorController->internalError("An error has occurred in index.php->run() : " . $e->getMessage());
}
