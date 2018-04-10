<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Database;

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
            die("An error has occurred : " . $e->getMessage());
        }
    }
}
