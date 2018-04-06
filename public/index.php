<?php
    require '../vendor/autoload.php';

    use Core\Application\Routing\Router;

    $router = new Router($_GET['url']);

    require_once "../etc/config/routing/routes.php";

    try {
        $router->run();
    } catch (\Exception $e) {
        die("An error has occurred : " . $e->getMessage());
    }