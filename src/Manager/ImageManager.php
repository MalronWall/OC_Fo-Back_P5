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

    public function replaceIdsPostByImages(array $objects)
    {
        foreach ($objects as $object) {
            $this->replaceIdPostByImage($object);
        }
        return $objects;
    }

    public function replaceIdPostByImage($object)
    {
        $image = $this->getImagePost($object->getId());
        $object->setImage($image);
        return $object;
    }

    public function replaceIdsUserByImages(array $objects)
    {
        foreach ($objects as $object) {
            $this->replaceIdUserByImage($object);
        }
        return $objects;
    }

    public function replaceIdUserByImage($object)
    {
        $image = $this->getImageUser($object->getId());
        $object->setImage($image);
        return $object;
    }

    public function createAndLinkImageUser($idUser)
    {
        if (empty($this->getImageUser($idUser))) {
            if ($this->createImageUser($idUser)) {
                $newImage = $this->getImageUser($idUser);
                if ($newImage != false) {
                    if ($this->linkImageUser($newImage[0]->getId(), $idUser)) {
                        return $newImage[0];
                    }
                }
            }
            return false;
        }
        return true;
    }
    
    private function createImageUser($idUser)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO image (id_User)
                                    VALUES (:idUser)
                                    ', [
            'idUser' => $idUser
        ]);

        return true;
    }

    private function linkImageUser($idImage, $idUser)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET id_Image = :idImage
                                    WHERE id = :idUser
                                    ', [
            'idImage' => $idImage,
            'idUser' => $idUser
        ]);
        
        return true;
    }
}
