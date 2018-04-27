<?php

require '../vendor/autoload.php';

use Core\Application\Routing\Router;

session_start();

$url = isset($_GET['url']) ?  $url = $_GET['url'] : '/';
$router = new Router($url);

require_once "../etc/config/routing/routes.php";

try {
    echo $router->run();
} catch (\Exception $e) {
    die("An error has occurred in index.php->run() : " . $e->getMessage());
}
