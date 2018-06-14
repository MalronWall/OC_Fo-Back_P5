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

    /**
     * @param $filename
     * @param array $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function render($filename, $params = [])
    {
        if (isset($_SESSION['flashbag'])) {
            $params['_flashbag'] = $_SESSION['flashbag'];
            unset($_SESSION['flashbag']);
        }

        return $this->getTwig()->render($filename, $params);
    }

    /**
     * @param string $page
     */
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

    /**
     * @param string $type
     * @param string $message
     */
    protected function addFlash(string $type, string $message)
    {
        $_SESSION['flashbag'] = compact('type', 'message');
    }
}
