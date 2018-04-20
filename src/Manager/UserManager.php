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

        $results = $this->fetchAllResults($req);

        return $results;
    }

    private function fetchAllResults($req)
    {
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(User::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
