<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Database;

use Blog\Controller\ErrorController;

class Hydrator
{
    public static function hydrate(string $class, string $datas)
    {
        try {
            $reflectClass = new \ReflectionClass($class);
            $class = $reflectClass->name;
            $object = new $class();

            return $object->unserialize($datas);
        } catch (\ReflectionException $e) {
            $errorController = new ErrorController();
            return $errorController->internalError(
                "An error has occurred in Hydrator.php->hydrate() : " . $e->getMessage()
            );
        }
    }
}
