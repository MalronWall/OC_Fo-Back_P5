<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Controller;

use Blog\Controller\ErrorController;
use Core\Application\Traits\CoreTrait;

abstract class AbstractController
{
    use CoreTrait;

    protected function render($filename, $params = [])
    {
        if (isset($_SESSION['flashbag'])) {
            $params['_flashbag'] = $_SESSION['flashbag'];
            unset($_SESSION['flashbag']);
        }

        try {
            return $this->getTwig()->render($filename, $params);
        } catch (\Twig_Error $e) {
            $errorController = new ErrorController();
            return $errorController->internalError(
                "An error has occurred in AbstractController.php->render() : " . $e->getMessage()
            );
        }
    }

    protected function redirect(string $page)
    {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        header('HTTP/1.1 Moved Permanently', false, 301);
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header("Location: http://$host$uri/$page");
        exit();
    }

    protected function addFlash(string $type, string $message)
    {
        $_SESSION['flashbag'] = compact('type', 'message');
    }
}
