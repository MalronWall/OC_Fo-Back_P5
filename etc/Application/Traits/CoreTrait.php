<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Traits;

trait CoreTrait
{
    protected $parameters;

    public function __construct()
    {
        $this->getParameters();
    }

    public function getParameters()
    {
        $this->parameters = require __DIR__ . '/../../config/controller/config.php';
    }

    public function getTwig()
    {
        $loader = new \Twig_Loader_Filesystem($this->parameters['templates']);
        $twig = new \Twig_Environment($loader, [
            'debug' => true,
            // Commenter le cache lors du développement !
            //'cache' => __DIR__ . '/../../../tmp'
        ]);

        return $twig;
    }
}
