<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Twig;

class MyExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('activeClass', [$this, 'activeClass'], ['needs_context' => true])
        ];
    }

    public function activeClass(array $context, $page)
    {
        //$context contient toutes les variables globales mises dans Twig
        $urlExploded = explode('/', $context['current_page']);
        if (isset($urlExploded[0]) && $urlExploded[0] === $page) {
            return ' active ';
        }
        return 'nope';
    }
}
