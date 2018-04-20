<?php

require '../vendor/autoload.php';

use Core\Application\Routing\Router;

session_start();

$router = new Router($_GET['url']);

require_once "../etc/config/routing/routes.php";

try {
    echo $router->run();
} catch (\Exception $e) {
    die("An error has occurred in index.php->run() : " . $e->getMessage());
}
