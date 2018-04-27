<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Controller;

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
            die("An error has occurred in AbstractController.php->render() : " . $e->getMessage());
        }
    }

    protected function redirect(string $uri)
    {
        //header('HTTP/1.1 Moved Permanently', false, 301);
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            header("Location: '.__DIR__.'$uri");
        } else {
            header("Location: $uri");
        }
        exit;
    }

    protected function addFlash(string $type, string $message)
    {
        $_SESSION['flashbag'] = compact('type', 'message');
    }
}
