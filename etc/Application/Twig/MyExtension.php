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
            new \Twig_SimpleFunction('currentPage', [$this, 'currentPage'], ['needs_context' => true]),
            new \Twig_SimpleFunction('urlExploded', [$this, 'urlExploded'], ['needs_context' => true])
        ];
    }

    public function activePage(array $context, $page)
    {
        //$urlExploded = explode('/', $context['current_page']);
        $urlExploded = $this->urlExploded($context);
        if (isset($urlExploded) && $urlExploded === $page) {
            return 'active';
        }
        return '';
    }

    public function currentPage(array $context, $page)
    {
        $urlExploded = $this->urlExploded($context);
        if (isset($urlExploded) && $urlExploded === $page) {
            return '<span class="sr-only">(current)</span>';
        }
        return '';
    }

    public function urlExploded(array $context)
    {
        //$context contient toutes les variables globales mises dans Twig
        $urlExploded = explode('/', $context['current_page']);
        return $urlExploded[0];
    }
}
