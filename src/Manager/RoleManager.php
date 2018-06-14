<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Blog\Model\Role;
use Core\Application\Database\AbstractManager;
use Core\Application\Database\Hydrator;

class RoleManager extends AbstractManager
{
    /**
     * RoleManager constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idRole
     * @return string
     */
    public function getRole($idRole)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM role
                                    WHERE id = :idRole
                                    ', [
            'idRole' => $idRole
        ]);

        return Hydrator::hydrate(Role::class, serialize(array_values($req->fetch())));
    }

    /**
     * @param $object
     * @return mixed
     */
    public function replaceIdByRole($object)
    {
        $role = $this->getRole($object->getRole());
        $object->setRole($role);
        return $object;
    }

    /**
     * @param array $objects
     * @return array
     */
    public function replaceIdsByRole(array $objects)
    {
        foreach ($objects as $object) {
            $this->replaceIdByRole($object);
        }
        return $objects;
    }
}
