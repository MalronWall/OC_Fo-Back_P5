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

    /**
     * CoreTrait constructor.
     */
    public function __construct()
    {
        $this->setParameters();
    }

    /**
     *
     */
    public function setParameters()
    {
        $this->parameters = require __DIR__ . '/../../config/controller/config.php';
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->parameters;
    }

    /**
     * @return \Twig_Environment
     */
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
        $twig->addExtension(new \Twig_Extensions_Extension_Text());
        $url = isset($_GET['url']) ?  $url = $_GET['url'] : '/';
        $twig->addGlobal('current_page', $url);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('server_name', $_SERVER['SERVER_NAME']);
        if ($_SERVER['SERVER_NAME']=='localhost') {
            $config = require __DIR__ . '/../../config/localhost/config.php';
            $twig->addGlobal(
                'path',
                $config['pathLocal']
            );
        } else {
            $twig->addGlobal('path', '/');
        }

        return $twig;
    }
}
