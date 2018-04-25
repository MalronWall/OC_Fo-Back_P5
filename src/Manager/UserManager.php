<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\User;
use Core\Application\Database\Hydrator;

class UserManager extends AbstractManager
{
    public function getUser($idUser)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    WHERE id = :idUser
                                    ', [
                                    'idUser' => $idUser
        ]);

        return Hydrator::hydrate(User::class, serialize(array_values($req->fetch())));
    }

    public function replaceIdsByUsers(array $objects)
    {
        foreach ($objects as $object) {
            $user = $this->getUser($object->getUser());
            $object->setUser($user);
        }
        return $objects;
    }

    public function replaceIdByUser($object)
    {
        $user = $this->getUser($object->getUser());
        $object->setUser($user);
        return $object;
    }
}
