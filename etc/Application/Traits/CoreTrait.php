<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Traits;

use Core\Application\Twig\MyExtension;

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

        $twig->addExtension(new \Twig_Extension_Debug());
        $twig->addExtension(new MyExtension());
        $twig->addGlobal('current_page', $_GET['url']);
        $twig->addGlobal('session', $_SESSION);
        if ($_SERVER['SERVER_NAME']=='localhost') {
            $config = require __DIR__ . '/../../config/localhost/config.php';
            $twig->addGlobal(
                'path',
                $config['pathLocal']
            );
        }

        return $twig;
    }
}
