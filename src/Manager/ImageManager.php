<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\Image;
use Core\Application\Database\Hydrator;

class ImageManager extends AbstractManager
{
    public function getImagePost($idPost)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM image
                                    WHERE id_Post = :idPost
                                    ', [
            'idPost' => $idPost
        ]);

        $results = $this->fetchAllResults($req);

        return $results;
    }

    public function getImageUser($idUser)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM image
                                    WHERE id_User = :idUser
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
            $results[] = Hydrator::hydrate(Image::class, serialize(array_values($datas)));
        }

        return $results;
    }

    public function replaceIdsByImages(array $objects)
    {
        foreach ($objects as $object) {
            $image = $this->getImageUser($object->getId());
            $object->setImage($image);
        }
        return $objects;
    }

    public function replaceIdByImage($object)
    {
        $image = $this->getImageUser($object->getId());
        $object->setImage($image);
        return $object;
    }
}
