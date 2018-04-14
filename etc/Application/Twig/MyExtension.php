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
            new \Twig_SimpleFunction('activePage', [$this, 'activePage'], ['needs_context' => true]),
            new \Twig_SimpleFunction('currentPage', [$this, 'currentPage'], ['needs_context' => true])
        ];
    }

    public function activePage(array $context, $page)
    {
        //$context contient toutes les variables globales mises dans Twig
        $urlExploded = explode('/', $context['current_page']);
        if (isset($urlExploded[0]) && $urlExploded[0] === $page) {
            return 'active';
        }
        return '';
    }

    public function currentPage(array $context, $page)
    {
        //$context contient toutes les variables globales mises dans Twig
        $urlExploded = explode('/', $context['current_page']);
        if (isset($urlExploded[0]) && $urlExploded[0] === $page) {
            return '<span class="sr-only">(current)</span>';
        }
        return '';
    }
}
