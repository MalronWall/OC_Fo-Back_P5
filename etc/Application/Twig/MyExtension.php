<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Twig;

class MyExtension extends \Twig_Extension
{
    /**
     * @return array|\Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        // RETURN ALL PUBLICS FUNCTIONS
        return [
            new \Twig_SimpleFunction('activePage', [$this, 'activePage'], ['needs_context' => true]),
            new \Twig_SimpleFunction('currentPage', [$this, 'currentPage'], ['needs_context' => true])
        ];
    }

    /**
     * @param array $context
     * @param $page
     * @return string
     */
    public function activePage(array $context, $page)
    {
        //$urlExploded = explode('/', $context['current_page']);
        $urlExploded = $this->urlExploded($context);
        if (isset($urlExploded) && $urlExploded === $page) {
            return 'active';
        }
        return '';
    }

    /**
     * @param array $context
     * @param $page
     * @return string
     */
    public function currentPage(array $context, $page)
    {
        $urlExploded = $this->urlExploded($context);
        if (isset($urlExploded) && $urlExploded === $page) {
            return '<span class="sr-only">(current)</span>';
        }
        return '';
    }

    /**
     * @param array $context
     * @return mixed
     */
    private function urlExploded(array $context)
    {
        //$context contient toutes les variables globales mises dans Twig
        $urlExploded = explode('/', $context['current_page']);
        return $urlExploded[0];
    }
}
